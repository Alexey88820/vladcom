<h3><?php echo empty($block->id) ? 'Создать новый блок' : 'Редактировать блок "' . $block->slug . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('role' => 'form')); ?>

	<div class="form-group">
		<label for="inputSlug">Идентификатор</label>
		<?=form_input(
			array(
				'name' => 'slug',
				'value' => $block->slug,
				'class' => 'form-control',
				'id' => 'inputSlug',
				'placeholder' => 'Введите идентификатор'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputTitle">Описание</label>
		<?=form_input(
			array(
				'name' => 'title',
				'value' => $block->title,
				'class' => 'form-control',
				'id' => 'inputTitle',
				'placeholder' => 'Введите описание'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputBody">Содержимое</label>
		<?=form_textarea(
			array(
				'name' => 'body',
				'value' => $block->body,
				'id' => 'inputBody',
				'class' => 'form-control tinymce'
			)
		); ?>
	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>



