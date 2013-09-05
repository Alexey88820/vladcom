<h2>Пользователи</h2>

<?php echo validation_errors(); ?>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/users/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="username" class="control-label">
            Логин
        </label>
        <div class="controls">
            <input type="text" name="username" id="username" value="<?=$form_values['username']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="password" class="control-label">
            Пароль
        </label>
        <div class="controls">
            <input type="password" name="password" id="password" value="" />
        </div>
    </div>

    <div class="control-group">
        <label for="description" class="control-label">
            Краткое описание
        </label>
        <div class="controls">
            <input type="text" name="description" id="description" value="<?=$form_values['description']?>" />
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" value="<?=$form_values['button']?>" class="btn btn-primary" />
        </div>
    </div>
</form>