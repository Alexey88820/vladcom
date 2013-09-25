<section>
	<h2>Страницы</h2>
	<div><?=anchor('admin/block/edit', '<span class="glyphicon glyphicon-plus"></span> Создать блок'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Идентификатор</th>
				<th>Название</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($blocks)): foreach($blocks as $block): ?>
		<tr>
			<td><?php echo anchor('admin/block/edit/' . $block->id, $block->slug); ?></td>
			<td><?php echo $block->title?></td>
			<td><?php echo btn_edit('admin/block/edit/' . $block->id); ?></td>
			<td><?php echo btn_delete('admin/block/delete/' . $block->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="4">Блоки не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>