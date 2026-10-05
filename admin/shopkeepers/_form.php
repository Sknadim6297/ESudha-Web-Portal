<?php
if (!defined('ESUDHA_SHOPKEEPER_FORM')) {
    http_response_code(404);
    exit('Not found.');
}

require_once __DIR__ . '/../../includes/admin.php';
require_admin();
?>
<div class="admin-panel admin-form">
    <?php if ($errorMessage !== ''): ?>
        <p class="alert alert-danger" role="alert"><?php echo html_escape($errorMessage); ?></p>
    <?php endif; ?>
    <form action="<?php echo html_escape($formAction); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
        <label for="shopkeeper-name">Shopkeeper name</label>
        <input class="form-control" id="shopkeeper-name" type="text" name="name" value="<?php echo html_escape($name); ?>" maxlength="150" required>
        <button class="admin-action" type="submit"><?php echo html_escape($submitLabel); ?></button>
        <a class="admin-action" href="<?php echo html_escape(admin_url('shopkeepers/index.php')); ?>">Cancel</a>
    </form>
</div>
