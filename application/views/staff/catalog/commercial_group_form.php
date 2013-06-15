<h2>Элементы групп коммерческих предложений</h2>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/catalog/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="title" class="control-label">
            Название
        </label>
        <div class="controls">
            <input type="text" name="title" id="title" value="<?=$form_values['title']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="slug" class="control-label">
            Slug
        </label>
        <div class="controls">
            <input type="text" name="slug" id="slug" value="<?=$form_values['slug']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="section" class="control-label">
            Раздел
        </label>
        <div class="controls">
            <select name="section" id="section">
            <?php foreach ($form_values['sections'] as $value) { ?>
                <?php
                if ($value['id']==$form_values['section']) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                ?>
                <option <?=$selected?> value="<?=$value['id']?>"><?=$value['name']?></option>
            <?php } ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label for="content" class="control-label">
            Содержимое
        </label>
        <div class="controls">
            <textarea name="content" id="content" class="ckeditor"><?=$form_values['content']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label for="img" class="control-label">
            Изображение
        </label>
        <div class="controls">
            <input type="text" name="img" id="img" value="<?=$form_values['img']?>" />
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