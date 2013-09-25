<h3><?php echo empty($photo->id) ? 'Добавить новый фотографию' : 'Редактировать фотографию'  ?>
	<?php if (!empty($photo->filename)) : ?>
		<img width=100 src="<?=site_url('assets/uploads/photos/' . $photo->filename)?>" alt="">
	<?php endif; ?>
</h3>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('', array('role' => 'form')); ?>
	<div class="form-group">
		<label for="inputFilename">Файл с изображением</label>
		<?=form_upload(
			array(
				'name'        => 'filename',
				// 'value'    => $photo->title,
				'class'       => 'form-control',
				'id'          => 'inputFilename',
				'placeholder' => 'Выберите файл с изображением'
			)
		); ?>

	</div>
	<div class="form-group">
		<label for="inputTitle">Заголовок фотографии</label>
		<?=form_input(
			array(
				'name' => 'title',
				'value' => $photo->title,
				'class' => 'form-control',
				'id' => 'inputTitle',
				'placeholder' => 'Введите заголовок'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputDescription">Описание</label>
		<?=form_textarea(
			array(
				'name' => 'description',
				'value' => $photo->description,
				'id' => 'inputDescription',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>


	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>