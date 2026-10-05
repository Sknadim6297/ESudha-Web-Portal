<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

function app_base_path(): string
{
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $adminPosition = strpos($scriptName, '/admin/');
    $authPosition = strpos($scriptName, '/auth/');

    if ($adminPosition === false && $authPosition === false) {
        $basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');

        return $basePath === '.' ? '' : $basePath;
    }

    if ($adminPosition === false || ($authPosition !== false && $authPosition < $adminPosition)) {
        return substr($scriptName, 0, $authPosition);
    }

    return substr($scriptName, 0, $adminPosition);
}

function site_url(string $path): string
{
    return app_base_path() . '/' . ltrim($path, '/');
}

function admin_url(string $path = ''): string
{
    $url = app_base_path() . '/admin';

    return $path === '' ? $url : $url . '/' . ltrim($path, '/');
}

function html_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function start_admin_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_name('ESUDHA_ADMIN_SESSION');

    $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== '' && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => app_base_path() . '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

function csrf_token(): string
{
    start_admin_session();

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && is_string($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function require_valid_csrf_token(): void
{
    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Invalid or expired form token. Please return to the previous page and try again.');
    }
}

function require_admin(): void
{
    start_admin_session();

    if (
        !isset($_SESSION['admin_id'])
        || !is_int($_SESSION['admin_id'])
        || ($_SESSION['is_admin'] ?? false) !== true
    ) {
        $_SESSION['login_error'] = 'Please sign in to access the admin area.';
        header('Location: ' . site_url('index.php?login=required'));
        exit;
    }
}

function require_post_request(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        header('Allow: POST');
        http_response_code(405);
        exit('This action requires a POST request.');
    }
}

function valid_shopkeeper_name($value): ?string
{
    if (!is_string($value)) {
        return null;
    }

    $name = trim($value);
    if ($name === '' || !mb_check_encoding($name, 'UTF-8') || mb_strlen($name, 'UTF-8') > 150) {
        return null;
    }

    if (preg_match('/[\p{Cc}]/u', $name) === 1) {
        return null;
    }

    return $name;
}

start_admin_session();
