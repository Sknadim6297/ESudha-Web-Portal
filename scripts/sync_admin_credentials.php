<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit("Not found.\n");
}

require_once __DIR__ . '/../config/database.php';

$mode = $argv[1] ?? '';
$checkOnly = $mode === '--check';
if ($mode !== '' && !$checkOnly) {
    fwrite(STDERR, "Usage: php scripts/sync_admin_credentials.php [--check]\n");
    exit(2);
}

function required_environment_value(string $name): string
{
    $value = getenv($name);
    if ($value === false || trim($value) === '') {
        fwrite(STDERR, sprintf("Set %s in the protected application environment.\n", $name));
        exit(1);
    }

    return trim($value);
}

$expectedEmail = strtolower(required_environment_value('ESUDHA_ADMIN_EXPECTED_EMAIL'));
$email = strtolower(required_environment_value('ESUDHA_ADMIN_EMAIL'));

foreach (['ESUDHA_ADMIN_EXPECTED_EMAIL' => $expectedEmail, 'ESUDHA_ADMIN_EMAIL' => $email] as $key => $value) {
    if (filter_var($value, FILTER_VALIDATE_EMAIL) === false || strlen($value) > 254) {
        fwrite(STDERR, sprintf("%s must be a valid email address.\n", $key));
        exit(1);
    }
}

$name = null;
$password = null;
if (!$checkOnly) {
    $name = required_environment_value('ESUDHA_ADMIN_NAME');
    $password = getenv('ESUDHA_ADMIN_PASSWORD');
    if ($password === false || strlen($password) < 12 || strlen($password) > 72) {
        fwrite(STDERR, "ESUDHA_ADMIN_PASSWORD must be between 12 and 72 bytes.\n");
        exit(1);
    }
    if (
        !mb_check_encoding($name, 'UTF-8')
        || mb_strlen($name, 'UTF-8') > 150
        || preg_match('/[\p{Cc}]/u', $name) === 1
    ) {
        fwrite(STDERR, "ESUDHA_ADMIN_NAME must contain between 1 and 150 valid characters.\n");
        exit(1);
    }
}

try {
    $pdo = database();
    $databaseIdentity = $pdo->query('SELECT DATABASE() AS database_name, @@hostname AS server_name, @@port AS server_port')->fetch();
    $databaseName = (string) $databaseIdentity['database_name'];
    $databaseServer = sprintf(
        '%s:%s',
        (string) $databaseIdentity['server_name'],
        (string) $databaseIdentity['server_port']
    );

    if ($checkOnly) {
        $findAdmin = $pdo->prepare('SELECT id, email FROM admins WHERE id = 1 LIMIT 1');
        $findAdmin->execute();
        $admin = $findAdmin->fetch();

        if (
            $admin === false
            || !in_array(strtolower((string) $admin['email']), [$expectedEmail, $email], true)
        ) {
            fwrite(STDERR, "Admin ID 1 does not match the expected or target email; no changes made.\n");
            exit(1);
        }

        $duplicate = $pdo->prepare('SELECT id FROM admins WHERE email = :email AND id <> 1 LIMIT 1');
        $duplicate->execute(['email' => $email]);
        if ($duplicate->fetch() !== false) {
            fwrite(STDERR, "The target email belongs to another admin; no changes made.\n");
            exit(1);
        }

        fwrite(STDOUT, sprintf(
            "Read-only check passed for admin ID 1 in database '%s' on MySQL server '%s'. No data was changed.\n",
            $databaseName,
            $databaseServer
        ));
        exit(0);
    }

    $pdo->beginTransaction();
    $findAdmin = $pdo->prepare('SELECT id, name, email, password FROM admins WHERE id = 1 LIMIT 1 FOR UPDATE');
    $findAdmin->execute();
    $admin = $findAdmin->fetch();

    if ($admin === false) {
        $pdo->rollBack();
        fwrite(STDERR, "Admin ID 1 was not found; no changes made.\n");
        exit(1);
    }

    $currentEmail = strtolower((string) $admin['email']);
    if (
        $currentEmail === $email
        && $admin['name'] === $name
        && password_verify($password, $admin['password'])
    ) {
        $pdo->commit();
        fwrite(STDOUT, sprintf(
            "Admin ID 1 is already synchronized in database '%s' on MySQL server '%s'. No changes made.\n",
            $databaseName,
            $databaseServer
        ));
        exit(0);
    }

    if ($currentEmail !== $expectedEmail) {
        $pdo->rollBack();
        fwrite(STDERR, "Admin ID 1 does not match ESUDHA_ADMIN_EXPECTED_EMAIL; no changes made.\n");
        exit(1);
    }

    $duplicate = $pdo->prepare('SELECT id FROM admins WHERE email = :email AND id <> 1 LIMIT 1');
    $duplicate->execute(['email' => $email]);
    if ($duplicate->fetch() !== false) {
        $pdo->rollBack();
        fwrite(STDERR, "The target email belongs to another admin; no changes made.\n");
        exit(1);
    }

    $updateAdmin = $pdo->prepare(
        'UPDATE admins
         SET name = :name, email = :email, password = :password
         WHERE id = 1 AND email = :expected_email'
    );
    $updateAdmin->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'expected_email' => $expectedEmail,
    ]);

    if ($updateAdmin->rowCount() !== 1) {
        throw new RuntimeException('The expected admin row was not updated.');
    }

    $pdo->commit();
    fwrite(STDOUT, sprintf(
        "Admin ID 1 synchronized in database '%s' on MySQL server '%s'. Password stored as a hash; no credentials were displayed.\n",
        $databaseName,
        $databaseServer
    ));
} catch (Throwable $exception) {
    if (isset($pdo) && $pdo instanceof PDO && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    error_log('Admin credential synchronization failed: ' . $exception->getMessage());
    fwrite(STDERR, "Admin credential synchronization failed. Check the server error log; no credentials were displayed.\n");
    exit(1);
}
