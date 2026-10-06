    <?php
    declare(strict_types=1);

    if (PHP_SAPI !== 'cli') {
        http_response_code(404);
        exit("Not found.\n");
    }

    require_once __DIR__ . '/../includes/admin.php';

    $name = getenv('ESUDHA_ADMIN_NAME') ?: 'Admin';
    $email = strtolower(trim((string) getenv('ESUDHA_ADMIN_EMAIL')));
    $password = (string) getenv('ESUDHA_ADMIN_PASSWORD');

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254) {
        fwrite(STDERR, "Set ESUDHA_ADMIN_EMAIL to a valid email address before running the seeder.\n");
        exit(1);
    }

    if (strlen($password) < 12 || strlen($password) > 72) {
        fwrite(STDERR, "Set ESUDHA_ADMIN_PASSWORD to a password between 12 and 72 bytes.\n");
        exit(1);
    }

    $name = valid_shopkeeper_name($name);
    if ($name === null) {
        fwrite(STDERR, "ESUDHA_ADMIN_NAME must contain between 1 and 150 valid characters.\n");
        exit(1);
    }

    $pdo = database();
    $existingAdmin = $pdo->prepare('SELECT id FROM admins WHERE email = :email LIMIT 1');
    $existingAdmin->execute(['email' => $email]);

    if ($existingAdmin->fetch() !== false) {
        fwrite(STDERR, "An admin with this email already exists. The seeder does not reset existing passwords.\n");
        exit(1);
    }

    $insertAdmin = $pdo->prepare(
        'INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)'
    );
    $insertAdmin->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    fwrite(STDOUT, "admin created successfully.\n");
    fwrite(STDOUT, 'Email: ' . $email . "\n");
    fwrite(STDOUT, "Password was stored as a hash and is not displayed.\n");
