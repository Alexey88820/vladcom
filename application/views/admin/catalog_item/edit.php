<h3><?php echo empty($catalog_item->id) ? 'Создать товар' : 'Редактировать товар "' . $catalog_item->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('', array('role' => 'form')); ?>

	<div class="form-group">
		<label for="inputSlug">Идентификатор</label>
		<?=form_input(
			array(
				'name' => 'slug',
				'value' => $catalog_item->slug,
				'class' => 'form-control',
				'id' => 'inputSlug',
				'placeholder' => 'Введите идентификатор'
			)
		); ?>
	</div>

	<div class="form-group">
		<label for="inputGroup">Группа</label>
		<?=form_dropdown(
			'group_id',
			$catalog_groups,
			$this->input->post('group_id') ? $this->input->post('group_id') : $catalog_item->group_id,
			'
				id="inputGroup" class="form-control"
			'
		); ?>
	</div>

	<div class="form-group">
		<label for="inputTitle">Название</label>
		<?=form_input(
			array(
				'name'        => 'title',
				'value'       => $catalog_item->title,
				'class'       => 'form-control',
				'id'          => 'inputTitle',
				'placeholder' => 'Введите название'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputPrice">Цена</label>
		<?=form_input(
			array(
				'name'        => 'price',
				'value'       => $catalog_item->price,
				'class'       => 'form-control',
				'id'          => 'inputPrice',
				'placeholder' => 'Введите цену'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputUnits">Единицы</label>
		<?=form_input(
			array(
				'name'        => 'units',
				'value'       => $catalog_item->units,
				'class'       => 'form-control',
				'id'          => 'inputUnits',
				'placeholder' => 'Введите единицы'
			)
		); ?>
	</div>
	<div class="form-group">
		<label for="inputBody">Текст</label>
		<?=form_textarea(
			array(
				'name'        => 'body',
				'value'       => $catalog_item->body,
				'class'       => 'form-control',
				'id'          => 'inputBody',
				'placeholder' => 'Введите текст',
				'class'		  => 'tinymce',
			)
		); ?>
	</div>

	<div class="form-group">
		<label for="inputImg">Ссылка на изображение</label>
		<?=form_input(
			array(
				'name'        => 'img',
				'value'       => $catalog_item->img,
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
		<?php if (!empty($catalog_item->img)) : ?>
			<img width=100 src="<?=$catalog_item->img?>" alt="">
		<?php endif; ?>
	</div>

	<div class="form-group">
		<label for="inputLeader">Добавить в лидеры продаж?</label>
		<?=form_checkbox(
			array(
			    'name'        => 'leader',
			    'id'          => 'inputLeader',
			    'value'       => 1,
			    'checked'     => (!empty($catalog_item->leader)) ? true : false,
			)
		);?>
	</div>

	<div class="form-group">
		<label for="inputAjaxGroup">Открывать ссылку в группах как AJAX-ссылку?</label>
		<?=form_checkbox(
			array(
			    'name'        => 'ajax_group',
			    'id'          => 'inputAjaxGroup',
			    'value'       => 1,
			    'checked'     => (!empty($catalog_item->ajax_group)) ? true : false,
			)
		);?>
		<span class="help-block">При просмотре информации о группе, товары будут отображаться в виде таблицы. Если эта галочка стоит, то клик открывает информацию о товаре прямо в этой таблице. Если нет - то на отдельной новой странице.</span>
	</div>

	<legend>Мета-информация для SEO</legend>

	<div class="form-group">
		<label for="inputMetaIndex">Разрешаем индексацию страницы?</label>
		<?=form_checkbox(
			array(
			    'name'        => 'meta_index',
			    'id'          => 'inputMetaIndex',
			    'value'       => 1,
			    'checked'     => (!empty($catalog_item->meta_index)) ? true : false,
			)
		);?>
	</div>

	<div class="form-group">
		<label for="inputMetaTitle">Мета-теги: Title</label>
		<?=form_input(
			array(
				'name'        => 'meta_title',
				'value'       => $catalog_item->meta_title,
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
				'value' => $catalog_item->meta_keywords,
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
				'value' => $catalog_item->meta_description,
				'id'    => 'inputMetaDescription',
				'class' => 'form-control no-tinymce'
			)
		); ?>
	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>
