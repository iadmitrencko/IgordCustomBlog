<?php if (!empty($successMessages)): ?>
    <div class="row">
        <div class="col alert alert-success">
            <?php foreach ($successMessages as $successMessage): ?>
                <span> <?php echo $successMessage->getValue(); ?> </span>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($errorMessages)): ?>
    <div class="row">
        <div class="col alert alert-danger">
            <?php foreach ($errorMessages as $errorMessage): ?>
                <span> <?php echo $errorMessage->getValue(); ?> </span>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>