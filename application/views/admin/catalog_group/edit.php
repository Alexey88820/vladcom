<h3><?php echo empty($catalog_group->id) ? 'Создать группу' : 'Редактировать группу "' . $catalog_group->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('', array('role' => 'form')); ?>

	<div class="form-group">
		<label for="inputSlug">Идентификатор</label>
		<?=form_input(
			array(
				'name' => 'slug',
				'value' => $catalog_group->slug,
				'class' => 'form-control',
				'id' => 'inputSlug',
				'placeholder' => 'Введите идентификатор'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputSection">Секция</label>
		<?=form_dropdown(
			'section_id',
			$catalog_sections,
			$this->input->post('section_id') ? $this->input->post('section_id') : $catalog_group->section_id,
			'
				id="inputSection" class="form-control"
			'
		); ?>
	</div>
	<div class="form-group">
		<label for="inputTitle">Название</label>
		<?=form_input(
			array(
				'name'        => 'title',
				'value'       => $catalog_group->title,
				'class'       => 'form-control',
				'id'          => 'inputTitle',
				'placeholder' => 'Введите название'
			)
		); ?>
	</div>

	<div class="form-group">
		<label for="inputImg">Ссылка на изображение</label>
		<?=form_input(
			array(
				'name'        => 'img',
				'value'       => $catalog_group->img,
				'class'       => 'form-control',
				'id'          => 'inputImg',
				'placeholder' => 'Введите ссылку'
			)
		); ?>
		<div>или</div>
		<label for="inputFileImg">Файл изображения</label>
		<?=form_upload(
			array(
				'name'        => 'file_img',
				'class'       => 'form-control',
				'id'          => 'inputFileImg',
				'placeholder' => 'Введите изображение'
			)
		); ?>
		<?php if (!empty($catalog_group->img)) : ?>
			<img width=100 src="<?=$catalog_group->img?>" alt="">
		<?php endif; ?>
	</div>

	<div class="form-group">
		<label for="inputAnnotation">Аннотация</label>
		<?=form_textarea(
			array(
				'name'        => 'annotation',
				'value'       => $catalog_group->annotation,
				'class'       => 'form-control',
				'id'          => 'inputAnnotation',
				'placeholder' => 'Введите аннотацию',
				'class'		  => 'tinymce',
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputBody">Текст</label>
		<?=form_textarea(
			array(
				'name'        => 'body',
				'value'       => $catalog_group->body,
				'class'       => 'form-control',
				'id'          => 'inputBody',
				'placeholder' => 'Введите текст',
				'class'		  => 'tinymce',
			)
		); ?>
	</div>

	<legend>Мета-информация для SEO</legend>

	<div class="form-group">
		<label for="inputMetaIndex">Разрешаем индексацию страницы?</label>
		<?=form_checkbox(
			array(
			    'name'        => 'meta_index',
			    'id'          => 'inputMetaIndex',
			    'value'       => 1,
			    'checked'     => (!empty($catalog_group->meta_index)) ? true : false,
			)
		);?>
	</div>
	<div class="form-group">
		<label for="inputMetaTitle">Мета-теги: Title</label>
		<?=form_input(
			array(
				'name'        => 'meta_title',
				'value'       => $catalog_group->meta_title,
				'class'       => 'form-control',
				'id'          => 'inputMetaTitle',
				'placeholder' => 'Введите title'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputMetaKeywords">Мета-теги: Keywords</label>
		<?=form_textarea(
			array(
				'name'  => 'meta_keywords',
				'value' => $catalog_group->meta_keywords,
				'id'    => 'inputMetaKeywords',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputMetaDescription">Мета-теги: Description</label>
		<?=form_textarea(
			array(
				'name'  => 'meta_description',
				'value' => $catalog_group->meta_description,
				'id'    => 'inputMetaDescription',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>
