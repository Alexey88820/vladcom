<h2>Блоки</h2>

<?php echo validation_errors(); ?>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/blocks/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="name" class="control-label">
            Название блока
        </label>
        <div class="controls">
            <input type="text" name="name" id="name" value="<?=$form_values['name']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="page" class="control-label">
            Страница
        </label>
        <div class="controls">
            <input type="text" name="page" id="page" value="<?=$form_values['page']?>" />
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
        <label for="text" class="control-label">
            Содержимое
        </label>
        <div class="controls">
            <textarea class="ckeditor" name="text" id="text"><?=$form_values['text']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" value="<?=$form_values['button']?>" class="btn btn-primary" />
        </div>
    </div>
</form>