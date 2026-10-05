<?php
require_once __DIR__ . '/../../includes/admin.php';
require_admin();

$pageTitle = isset($pageTitle) ? $pageTitle : 'Admin';
$isAdminAuthenticated = isset($_SESSION['admin_id'])
    && is_int($_SESSION['admin_id'])
    && ($_SESSION['is_admin'] ?? false) === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo html_escape($pageTitle); ?> | E-Sudha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo html_escape(site_url('css/bootstrap.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo html_escape(site_url('css/style.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo html_escape(site_url('css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,900" rel="stylesheet">
</head>
<body>
    <header class="header admin-site-header">
        <div class="container admin-nav">
            <a href="<?php echo html_escape($isAdminAuthenticated ? admin_url('dashboard.php') : site_url('index.php')); ?>">
                E-Sudha
            </a>
            <?php if ($isAdminAuthenticated): ?>
                <nav class="admin-nav-links" aria-label="Admin navigation">
                    <a href="<?php echo html_escape(admin_url('dashboard.php')); ?>">Dashboard</a>
                    <a href="<?php echo html_escape(admin_url('shopkeepers/index.php')); ?>">Shopkeepers</a>
                    <form action="<?php echo html_escape(admin_url('logout.php')); ?>" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
                        <button type="submit">Logout</button>
                    </form>
                </nav>
            <?php else: ?>
                <a href="<?php echo html_escape(site_url('index.php')); ?>">Home</a>
            <?php endif; ?>
        </div>
    </header>
    <main class="team admin-page">
        <div class="container">
