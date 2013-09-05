<h2>Элементы секций</h2>

<?php echo validation_errors(); ?>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/catalog/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="name" class="control-label">
            Название
        </label>
        <div class="controls">
            <input type="text" name="name" id="name" value="<?=$form_values['name']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="slug" class="control-label">
            Алиас
        </label>
        <div class="controls">
            <input type="text" name="slug" id="slug" value="<?=$form_values['slug']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="description" class="control-label">
            Описание
        </label>
        <div class="controls">
            <textarea name="description" id="description" class="ckeditor"><?=$form_values['description']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label for="meta_title" class="control-label">
            Мета-теги: Title
        </label>
        <div class="controls">
            <textarea name="meta_title" id="meta_title"><?=$form_values['meta_title']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label for="meta_keywords" class="control-label">
            Мета-теги: Keywords
        </label>
        <div class="controls">
            <textarea name="meta_keywords" id="meta_keywords"><?=$form_values['meta_keywords']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label for="meta_description" class="control-label">
            Мета-теги: Description
        </label>
        <div class="controls">
            <textarea name="meta_description" id="meta_description"><?=$form_values['meta_description']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" value="<?=$form_values['button']?>" class="btn btn-primary" />
        </div>
    </div>
</form>