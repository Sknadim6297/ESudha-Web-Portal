<?php
require_once __DIR__ . '/../../includes/admin.php';
require_admin();

$statement = database()->prepare('SELECT id, name, created_at, updated_at FROM shopkeepers ORDER BY name, id');
$statement->execute();
$shopkeepers = $statement->fetchAll();

$statusMessages = [
    'created' => 'Shopkeeper added successfully.',
    'updated' => 'Shopkeeper updated successfully.',
    'deleted' => 'Shopkeeper deleted successfully.',
];
$status = $_GET['status'] ?? '';
$pageTitle = 'Shopkeepers';
require __DIR__ . '/../includes/header.php';
?>
            <div class="w3_agile_team_grid">
                <div class="w3_agile_team_grid_left">
                    <h3 class="w3l_header w3_agileits_header">Shopkeepers</h3>
                    <p class="sub_para_agile"></p>
                </div>
            </div>
            <?php if (is_string($status) && isset($statusMessages[$status])): ?>
                <p class="alert alert-success" role="status"><?php echo html_escape($statusMessages[$status]); ?></p>
            <?php endif; ?>
            <div class="admin-shopkeepers-toolbar">
                <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/create.php')); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Shopkeeper</a>
            </div>
            <div class="admin-panel table-responsive admin-shopkeepers-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($shopkeepers) === 0): ?>
                            <tr><td colspan="4">No shopkeepers have been added yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($shopkeepers as $index => $shopkeeper): ?>
                                <tr>
                                    <td><?php echo sprintf('%02d', $index + 1); ?></td>
                                    <td><?php echo html_escape($shopkeeper['name']); ?></td>
                                    <td><?php echo html_escape($shopkeeper['created_at']); ?></td>
                                    <td>
                                        <div class="admin-shopkeeper-actions">
                                            <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/edit.php?id=' . (int) $shopkeeper['id'])); ?>">Edit</a>
                                            <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/delete.php?id=' . (int) $shopkeeper['id'])); ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
