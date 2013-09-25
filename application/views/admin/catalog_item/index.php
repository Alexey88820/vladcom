<section>
	<h2>Товар</h2>
	<div><?=anchor('admin/catalog_item/edit', '<span class="glyphicon glyphicon-plus"></span> Создать товар'); ?></div>
	<div><?=anchor('admin/catalog_item/order', '<span class="glyphicon glyphicon-move"></span> Сортировать товары'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Название</th>
				<th>Цена</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($catalog_items)): foreach($catalog_items as $catalog_item): ?>
		<tr>
			<td><?php echo anchor('admin/catalog_item/edit/' . $catalog_item->id, $catalog_item->title); ?></td>
			<td><?=$catalog_item->price?></td>
			<td><?php echo btn_edit('admin/catalog_item/edit/' . $catalog_item->id); ?></td>
			<td><?php echo btn_delete('admin/catalog_item/delete/' . $catalog_item->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="4">Секции не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>