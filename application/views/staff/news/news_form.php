<h2>Новости</h2>

<?php echo validation_errors(); ?>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/news/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="header" class="control-label">
            Заголовок новости
        </label>
        <div class="controls">
            <input type="input" name="header" value="<?=$form_values['header']?>" />
        </div>
    </div>
    <div class="control-group">
        <label for="text" class="control-label">
            Текст новости
        </label>
        <div class="controls">
            <textarea class="ckeditor" name="text"><?=$form_values['text']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" value="<?=$form_values['button']?>" class="btn btn-primary" />
        </div>
    </div>
</form>