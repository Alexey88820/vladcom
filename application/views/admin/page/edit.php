<h3><?php echo empty($page->id) ? 'Создать новую страницу' : 'Редактировать страницу "' . $page->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('role' => 'form')); ?>
	<div class="form-group">
		<label for="inputTitle">Название страницы</label>
		<?=form_input(array('name' => 'title', 'value' => $page->title, 'class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'Введите название страницы')); ?>
	</div>
	<div class="form-group">
		<label for="inputSlug">Латинское имя страницы</label>
		<?=form_input(array('name' => 'slug', 'value' => $page->slug, 'class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'Введите латинское имя страницы')); ?>
	</div>
	<div class="form-group">
		<label for="inputBody">Содержимое</label>
		<?=form_textarea(
			array(
				'name' => 'body',
				'value' => $page->body,
				'id' => 'inputBody',
				'class' => 'form-control tinymce'
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
			    'value'       => $page->meta_index,
			    'checked'     => TRUE,
			)
		);?>
	</div>

	<div class="form-group">
		<label for="inputMetaTitle">Мета-теги: Title</label>
		<?=form_input(
			array(
				'name' => 'meta_title',
				'value' => $page->meta_title,
				'class' => 'form-control',
				'id' => 'inputMetaTitle',
				'placeholder' => 'Введите title'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputMetaKeywords">Мета-теги: Keywords</label>
		<?=form_textarea(
			array(
				'name' => 'meta_keywords',
				'value' => $page->meta_keywords,
				'id' => 'inputMetaKeywords',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputMetaDescription">Мета-теги: Description</label>
		<?=form_textarea(
			array(
				'name' => 'meta_description',
				'value' => $page->meta_description,
				'id' => 'inputMetaDescription',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>



