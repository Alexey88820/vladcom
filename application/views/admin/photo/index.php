<section>
	<h2>Фотографии</h2>
	<div><?=anchor('admin/photo/edit', '<span class="glyphicon glyphicon-plus"></span> Добавить фотографию'); ?></div>
	<div><?=anchor('admin/photo/order', '<span class="glyphicon glyphicon-move"></span> Сортировать фотографии'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Изображение</th>
				<th>Описание</th>
				<th>Ссылка</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($photos)): foreach($photos as $photo): ?>
		<tr>
			<td><a href="<?=site_url('admin/photo/edit/' . $photo->id)?>"><img width=100 src="<?=site_url('assets/uploads/photos/' . $photo->filename)?>" alt=""></a></td>
			<td><?php echo $photo->title;?></td>
			<td><?php echo anchor('admin/photo/edit/' . $photo->id, $photo->description); ?></td>
			<td><?php echo btn_edit('admin/photo/edit/' . $photo->id); ?></td>
			<td><?php echo btn_delete('admin/photo/delete/' . $photo->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Фотографии не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>