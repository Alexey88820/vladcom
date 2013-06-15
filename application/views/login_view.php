<?php echo validation_errors(); ?>
<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open('verifylogin', $attributes); ?>
  <legend>Авторизация</legend>
  <div class="control-group">
    <label class="control-label" for="username">Логин</label>
    <div class="controls">
      <input type="text" id="username" name="username" placeholder="Имя пользователя" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Пароль</label>
    <div class="controls">
      <input type="password" id="password" name="password" placeholder="Пароль пользоавтеля" />
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary" value="Login">Вход</button>
    </div>
  </div>
</form>