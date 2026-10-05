<?php
require_once __DIR__ . '/../includes/admin.php';
require_admin();

$pageTitle = 'Admin Dashboard';
require __DIR__ . '/includes/header.php';
?>
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Admin Dashboard</h3>
                </div>
            </div>
            <section class="admin-panel admin-dashboard-panel">
                <h3>Welcome, <?php echo html_escape((string) ($_SESSION['admin_name'] ?? 'Admin')); ?></h3>
                <div class="admin-dashboard-card">
                    <h4>Shopkeepers</h4>
                    <p>Manage shopkeeper records shown on the public website.</p>
                    <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/index.php')); ?>">Manage Shopkeepers</a>
                </div>
            </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
