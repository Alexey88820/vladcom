<h2>Редактирование основной информации и главной страницы</h2>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('staff/main/' . $operation, $attributes) ?>

    <div class="control-group">
        <div class="controls">
            <legend>Информация в шапке и подвале сайта:</legend>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="site_name">
            Название компании
        </label>
        <div class="controls">
            <input type="text" name="site_name" id="site_name" value="<?=$form_values['site_name']?>" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="site_description">
            Краткое описание
        </label>
        <div class="controls">
            <input type="text" name="site_description" id="site_description" value="<?=$form_values['site_description']?>" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="phone1">
            Телефон
        </label>
        <div class="controls">
            <input type="text" name="phone1" id="phone1" value="<?=$form_values['phone1']?>" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="phone2">
            Телефон 2
        </label>
        <div class="controls">
            <input type="text" name="phone2" id="phone2" value="<?=$form_values['phone2']?>" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="email">
            Email
        </label>
        <div class="controls">
            <input type="text" name="email" id="email" value="<?=$form_values['email']?>" />
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input type="submit" name="submit" class="btn btn-large btn-primary" value="<?=$form_values['button']?>" />
        </div>
    </div>
</form>