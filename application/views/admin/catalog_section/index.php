<section>
	<h2>Товар</h2>
	<div><?=anchor('admin/catalog_section/edit', '<span class="glyphicon glyphicon-plus"></span> Создать секцию'); ?></div>
	<div><?=anchor('admin/catalog_section/order', '<span class="glyphicon glyphicon-move"></span> Сортировать секции'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Название</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($catalog_sections)): foreach($catalog_sections as $catalog_section): ?>
		<tr>
			<td><?php echo anchor('admin/catalog_section/edit/' . $catalog_section->id, $catalog_section->title); ?></td>
			<td><?php echo btn_edit('admin/catalog_section/edit/' . $catalog_section->id); ?></td>
			<td><?php echo btn_delete('admin/catalog_section/delete/' . $catalog_section->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Секции не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>