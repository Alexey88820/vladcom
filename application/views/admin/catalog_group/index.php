<section>
	<h2>Товар</h2>
	<div><?=anchor('admin/catalog_group/edit', '<span class="glyphicon glyphicon-plus"></span> Создать группу'); ?></div>
	<div><?=anchor('admin/catalog_group/order', '<span class="glyphicon glyphicon-move"></span> Сортировать группы'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Название</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($catalog_groups)): foreach($catalog_groups as $catalog_group): ?>
		<tr>
			<td><?php echo anchor('admin/catalog_group/edit/' . $catalog_group->id, $catalog_group->title); ?></td>
			<td><?php echo btn_edit('admin/catalog_group/edit/' . $catalog_group->id); ?></td>
			<td><?php echo btn_delete('admin/catalog_group/delete/' . $catalog_group->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Группы не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>