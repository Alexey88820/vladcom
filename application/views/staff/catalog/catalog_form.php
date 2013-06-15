<h2>Элементы каталога</h2>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/catalog/' . $operation, $attributes) ?>

    <div class="control-group">
        <label for="name" class="control-label">
            Название товара
        </label>
        <div class="controls">
            <input type="text" name="name" id="name" class="input-large" value="<?=$form_values['name']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="slug" class="control-label">
            Alias
        </label>
        <div class="controls">
            <input type="text" name="slug" id="slug" class="input-large" value="<?=$form_values['slug']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="price" class="control-label">
            Цена
        </label>
        <div class="controls">
            <input type="text" name="price" id="price" value="<?=$form_values['price']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="units" class="control-label">
            Единицы
        </label>
        <div class="controls">
            <input type="text" name="units" id="units" value="<?=$form_values['units']?>" />
        </div>
    </div>

    <div class="control-group">
        <label for="group" class="control-label">
            Группа товаров
        </label>
        <div class="controls">
            <select name="group" id="group">
            <?php foreach ($form_values['groups'] as $value) { ?>
                <?php if ($form_values['group']==$value['id']) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                } ?>
                <option <?=$selected?> value="<?=$value['id']?>"><?=$value['name']?></option>
            <?php } ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label for="description" class="control-label">
            Краткое описание
        </label>
        <div class="controls">
            <textarea class="ckeditor" name="description" id="description"><?=$form_values['description']?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label for="full_description" class="control-label">
            Полное описание
        </label>
        <div class="controls">
            <textarea class="ckeditor" name="full_description" id="full_description"><?=$form_values['full_description']?></textarea>
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