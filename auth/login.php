<?php
require_once __DIR__ . '/../includes/admin.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('This action requires a POST request.');
}

$identifierInput = $_POST['identifier'] ?? null;
$passwordInput = $_POST['password'] ?? null;
$identifier = is_string($identifierInput) ? trim($identifierInput) : '';
$password = is_string($passwordInput) ? $passwordInput : '';
$loginError = 'Invalid ID/Email or password';

if (
    verify_csrf_token($_POST['csrf_token'] ?? null)
    && $identifier !== ''
    && strlen($identifier) <= 254
    && preg_match('/[\p{Cc}]/u', $identifier) !== 1
    && $password !== ''
    && strlen($password) <= 4096
) {
    $adminId = ctype_digit($identifier) ? (int) $identifier : 0;
    $statement = database()->prepare(
        'SELECT id, name, email, password FROM admins
         WHERE email = :email OR id = :id
         LIMIT 1'
    );
    $statement->bindValue(':email', strtolower($identifier), PDO::PARAM_STR);
    $statement->bindValue(':id', $adminId, PDO::PARAM_INT);
    $statement->execute();
    $admin = $statement->fetch();

    if ($admin !== false && password_verify($password, $admin['password'])) {
        session_regenerate_id(true);
        unset($_SESSION['csrf_token'], $_SESSION['login_error'], $_SESSION['login_email']);
        $_SESSION['admin_id'] = (int) $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['is_admin'] = true;

        header('Location: ' . site_url('admin/dashboard.php'));
        exit;
    }
}

$_SESSION['login_error'] = $loginError;
if (filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false) {
    $_SESSION['login_email'] = $identifier;
}

header('Location: ' . site_url('index.php?login=failed'));
exit;
