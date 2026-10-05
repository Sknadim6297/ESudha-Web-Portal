<?php
require_once __DIR__ . '/includes/admin.php';

$loginError = '';
$loginEmail = '';
$shopkeepersLoadError = false;

try {
    $statement = database()->prepare('SELECT name FROM shopkeepers ORDER BY name, id');
    $statement->execute();
    $shopkeepers = $statement->fetchAll();
} catch (PDOException $exception) {
    error_log('Unable to load shopkeepers: ' . $exception->getMessage());
    http_response_code(500);
    $shopkeepers = [];
    $shopkeepersLoadError = true;
}

$headerActivePage = 'shopkeepers';
$headerLabelSpacing = ' ';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Sudha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,900" rel="stylesheet">
</head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>
    <img src="images/about-banner.jpg" class="img-responsive" style="margin-top: 20px;" alt="">
    <div class="team">
        <div class="container">
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Shopkeepers</h3>
                    <p class="sub_para_agile"></p>
                </div>
            </div>
            <?php if ($shopkeepersLoadError): ?>
                <p class="shopkeeper-message alert alert-danger" role="alert">Shopkeeper information is temporarily unavailable.</p>
            <?php elseif (count($shopkeepers) > 0): ?>
                <div class="shopkeeper-grid">
                    <?php foreach ($shopkeepers as $index => $shopkeeper): ?>
                        <div class="shopkeeper-card">
                            <span class="shopkeeper-serial"><?php echo sprintf('%02d', $index + 1); ?></span>
                            <span class="shopkeeper-name"><?php echo html_escape($shopkeeper['name']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="shopkeeper-message">No shopkeepers available.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer_agile_w3ls">
        <div class="container">
            <div class="agileits_w3layouts_logo logo2">
                <?php $footerBrand = 'E-Sudha'; require __DIR__ . '/includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="signin-form profile">
                        <h3 class="agileinfo_sign">Sign In</h3>
                        <div class="login-form">
                            <form action="auth/login.php" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
                                <input type="text" name="identifier" placeholder="ID/Email" autocomplete="username" maxlength="254" required>
                                <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                                <div class="tp">
                                    <input type="submit" value="Sign In">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="signin-form profile">
                        <h3 class="agileinfo_sign">Sign Up Coming Soon</h3>
                        <p>Sign Up Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
