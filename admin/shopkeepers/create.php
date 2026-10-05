<?php
require_once __DIR__ . '/../../includes/admin.php';
require_admin();

$name = '';
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
        $statement = database()->prepare('INSERT INTO shopkeepers (name) VALUES (:name)');
        $statement->execute(['name' => $validatedName]);
        header('Location: ' . admin_url('shopkeepers/index.php?status=created'));
        exit;
    }
}

$pageTitle = 'Add Shopkeeper';
$formAction = admin_url('shopkeepers/create.php');
$submitLabel = 'Save';
require __DIR__ . '/../includes/header.php';
?>
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Add Shopkeeper</h3>
                </div>
            </div>
<?php define('ESUDHA_SHOPKEEPER_FORM', true); require __DIR__ . '/_form.php'; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
