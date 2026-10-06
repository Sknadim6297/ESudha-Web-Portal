<?php
declare(strict_types=1);

function load_database_environment(string $file): void
{
    if (!file_exists($file)) {
        return;
    }

    if (!is_readable($file)) {
        throw new RuntimeException('The application .env file exists but is not readable.');
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        throw new RuntimeException('Unable to read the application .env file.');
    }

    foreach ($lines as $lineNumber => $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') {
            continue;
        }

        if (!preg_match('/^(?:export\s+)?([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(.*)$/', $line, $matches)) {
            throw new RuntimeException(sprintf('Invalid .env entry on line %d.', $lineNumber + 1));
        }

        $name = $matches[1];
        if (getenv($name) !== false) {
            continue;
        }

        $value = trim($matches[2]);
        if ($value !== '' && ($value[0] === '"' || $value[0] === "'")) {
            $quote = $value[0];
            if (strlen($value) < 2 || substr($value, -1) !== $quote) {
                throw new RuntimeException(sprintf('Unclosed quoted value in .env on line %d.', $lineNumber + 1));
            }

            $value = substr($value, 1, -1);
            if ($quote === '"') {
                $value = stripcslashes($value);
            }
        } else {
            $value = preg_replace('/\s+#.*$/', '', $value);
            $value = trim($value);
        }

        putenv($name . '=' . $value);
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

$environmentFile = getenv('ESUDHA_ENV_FILE');
if ($environmentFile === false || trim($environmentFile) === '') {
    $environmentFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
}
load_database_environment($environmentFile);

function database(): PDO
{
    static $connection;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = getenv('DB_HOST') ?: (getenv('ESUDHA_DB_HOST') ?: 'localhost');
    $name = getenv('DB_NAME') ?: (getenv('ESUDHA_DB_NAME') ?: 'esudha_db');
    $username = getenv('DB_USER');
    if ($username === false) {
        $username = getenv('ESUDHA_DB_USER');
    }

    $password = getenv('DB_PASS');
    if ($password === false) {
        $password = getenv('ESUDHA_DB_PASSWORD');
    }

    if ($username === false || $username === '') {
        throw new RuntimeException('Set DB_USER to the MySQL database username.');
    }
    if ($password === false) {
        throw new RuntimeException('Set DB_PASS to the MySQL database password. Use an empty value only if the database account has no password.');
    }

    $port = getenv('DB_PORT');
    if ($port === false) {
        $port = getenv('ESUDHA_DB_PORT');
    }
    if ($port === false) {
        $port = '3306';
    }

    $port = filter_var($port, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 65535],
    ]);
    if ($port === false) {
        throw new RuntimeException('DB_PORT must be an integer between 1 and 65535.');
    }

    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $host, $port, $name);
    $connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $connection;
}
