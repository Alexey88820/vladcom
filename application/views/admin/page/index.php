<section>
	<h2>Страницы</h2>
	<div><?=anchor('admin/page/edit', '<span class="glyphicon glyphicon-plus"></span> Создать страницу'); ?></div>
	<div><?=anchor('admin/page/order', '<span class="glyphicon glyphicon-move"></span> Сортировать страницы'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Название</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($pages)): foreach($pages as $page): ?>
		<tr>
			<td><?php echo anchor('admin/page/edit/' . $page->id, $page->title); ?></td>
			<td><?php echo btn_edit('admin/page/edit/' . $page->id); ?></td>
			<td><?php echo btn_delete('admin/page/delete/' . $page->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Страницы не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>