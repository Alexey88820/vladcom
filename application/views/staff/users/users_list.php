<table class="table">
    <thead>
        <tr>
            <th>Логин</th>
            <th>Краткое описание</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $user) { ?>
            <tr>
                <td><a href="<?=base_url()?>staff/users/edit/<?=$user['id']?>"><?=$user['username']?></a></td>
                <td><?=$user['description']?></td>
                <td><a href="<?=base_url()?>staff/users/delete/<?=$user['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>