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

$name = $shopkeeper['name'];
$errorMessage = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    require_post_request();
    require_valid_csrf_token();
    $validatedName = valid_shopkeeper_name($_POST['name'] ?? null);

    if ($validatedName === null) {
        $errorMessage = 'Enter a shopkeeper name of 1 to 150 characters.';
        $submittedName = $_POST['name'] ?? '';
        $name = is_string($submittedName) ? $submittedName : '';
    } else {
        $updateShopkeeper = database()->prepare('UPDATE shopkeepers SET name = :name WHERE id = :id');
        $updateShopkeeper->execute([
            'name' => $validatedName,
            'id' => $id,
        ]);
        header('Location: ' . admin_url('shopkeepers/index.php?status=updated'));
        exit;
    }
}

$pageTitle = 'Edit Shopkeeper';
$formAction = admin_url('shopkeepers/edit.php?id=' . $id);
$submitLabel = 'Update';
require __DIR__ . '/../includes/header.php';
?>
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Edit Shopkeeper</h3>
                </div>
            </div>
<?php define('ESUDHA_SHOPKEEPER_FORM', true); require __DIR__ . '/_form.php'; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
