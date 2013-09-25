<h3><?php echo empty($article->id) ? 'Создать новую заметку' : 'Редактировать заметку "' . $article->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('role' => 'form')); ?>
	<div class="form-group">
		<label for="inputTitle">Название заметки</label>
		<?=form_input(array('name' => 'title', 'value' => $article->title, 'class' => 'form-control', 'id' => 'inputTitle', 'placeholder' => 'Введите название новости')); ?>
	</div>
	<div class="form-group">
		<label for="inputBody">Содержимое</label>
		<?=form_textarea('body', set_value('body', $article->body), 'class="tinymce"'); ?>
	</div>

	<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
<?php echo form_close();?>



