<?php
require_once __DIR__ . '/../../includes/admin.php';
require_admin();

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false) {
    http_response_code(400);
    exit('A valid shopkeeper ID is required.');
}

$findShopkeeper = database()->prepare('SELECT id, name FROM shopkeepers WHERE id = :id LIMIT 1');
$findShopkeeper->execute(['id' => $id]);
$shopkeeper = $findShopkeeper->fetch();

if ($shopkeeper === false) {
    http_response_code(404);
    exit('Shopkeeper not found.');
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    require_post_request();
    require_valid_csrf_token();

    $deleteShopkeeper = database()->prepare('DELETE FROM shopkeepers WHERE id = :id');
    $deleteShopkeeper->execute(['id' => $id]);
    header('Location: ' . admin_url('shopkeepers/index.php?status=deleted'));
    exit;
}

$pageTitle = 'Delete Shopkeeper';
require __DIR__ . '/../includes/header.php';
?>
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Delete Shopkeeper</h3>
                </div>
            </div>
            <section class="admin-panel">
                <p>Are you sure you want to delete <strong><?php echo html_escape($shopkeeper['name']); ?></strong>?</p>
                <form action="<?php echo html_escape(admin_url('shopkeepers/delete.php?id=' . (int) $shopkeeper['id'])); ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
                    <button class="admin-action" type="submit">Confirm Delete</button>
                    <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/index.php')); ?>">Cancel</a>
                </form>
            </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
