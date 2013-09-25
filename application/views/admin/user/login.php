<div class="modal-header">
	<h3>Вход</h3>
	<p>Введите свои данные</p>
</div>
<div class="modal-body">
	<?php echo validation_errors(); ?>
	<?php echo form_open('', array('role' => 'form')); ?>
		<div class="form-group">
	    	<label for="inputUsername">Имя пользователя</label>
	    	<?=form_input(array('name' => 'username', 'class' => 'form-control', 'id' => 'inputUsername', 'placeholder' => 'Введите имя пользователя')); ?>
	  	</div>
	  	<div class="form-group">
	  		<label for="inputPassword">Пароль</label>
	  		<?=form_password(array('name' => 'password', 'class' => 'form-control', 'id' => 'inputPassword', 'placeholder' => 'Введите пароль')); ?>
	  	</div>

		<?php echo form_submit('submit', 'Вход', 'class="btn btn-primary"'); ?>
	<?php echo form_close();?>
</div>