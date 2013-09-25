<h3><?php echo empty($user->id) ? 'Создать нового пользователя' : 'Редактировать пользователя ' . $user->username; ?></h3>

<?php echo validation_errors(); ?>

<?php echo form_open('', array('role' => 'form')); ?>
	<div class="form-group">
    	<label for="inputUsername">Имя пользователя</label>
    	<?=form_input(array('name' => 'username', 'value' => $user->username, 'class' => 'form-control', 'id' => 'inputUsername', 'placeholder' => 'Введите имя пользователя')); ?>
  	</div>
  	<div class="form-group">
  		<label for="inputPassword">Пароль</label>
  		<?=form_password(array('name' => 'password', 'class' => 'form-control', 'id' => 'inputPassword', 'placeholder' => 'Введите пароль')); ?>
  	</div>
  	<div class="form-group">
  		<label for="inputConfirmPassword">Пароль еще раз</label>
  		<?=form_password(array('name' => 'password_confirm', 'class' => 'form-control', 'id' => 'inputConfirmPassword', 'placeholder' => 'Введите пароль еще раз')); ?>
  	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>
