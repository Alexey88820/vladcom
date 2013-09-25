<section>
	<h2>Пользователи</h2>
	<div><?php echo anchor('admin/user/edit', '<span class="glyphicon glyphicon-plus"></span> Создать пользователя'); ?></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Имя пользователя</th>
				<th>Ред.</th>
				<th>Уд.</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($users)): foreach($users as $user): ?>
		<tr>
			<td><?php echo anchor('admin/user/edit/' . $user->id, $user->username); ?></td>
			<td><?php echo btn_edit('admin/user/edit/' . $user->id); ?></td>
			<td><?php echo btn_delete('admin/user/delete/' . $user->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">Пользователей нет</td>
		</tr>
<?php endif; ?>
		</tbody>
	</table>
</section>