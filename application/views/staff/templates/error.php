<?php $validation_errors = validation_errors(); ?>
<?php if (!empty($validation_errors)) { ?>
    <div class="alert alert-error">
        <?=validation_errors()?>
    </div>
<?php } elseif (!empty($error_message)) { ?>
    <div class="alert alert-error">
        <?=$error_message?>
    </div>
<?php } ?>

