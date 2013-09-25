<section>
	<h2>Новости</h2>
	<div><?=anchor('admin/news/edit', '<span class="glyphicon glyphicon-plus"></span> Создать заметку'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Название</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($articles)): foreach($articles as $article): ?>
		<tr>
			<td><?php echo anchor('admin/article/edit/' . $article->id, $article->title); ?></td>
			<td><?php echo btn_edit('admin/article/edit/' . $article->id); ?></td>
			<td><?php echo btn_delete('admin/article/delete/' . $article->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Заметки не найдены.</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>