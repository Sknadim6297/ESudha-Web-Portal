<?php
require_once __DIR__ . '/../includes/admin.php';
require_admin();
require_post_request();
require_valid_csrf_token();

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $cookieParameters = session_get_cookie_params();
    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $cookieParameters['path'],
        'domain' => $cookieParameters['domain'],
        'secure' => $cookieParameters['secure'],
        'httponly' => $cookieParameters['httponly'],
        'samesite' => 'Lax',
    ]);
}

session_destroy();

header('Location: ' . site_url('index.php'));
exit;
