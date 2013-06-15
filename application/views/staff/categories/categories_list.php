<table class="table">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Название</th>
            <th>Описание</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $category) { ?>
            <tr>
                <td><a href="<?=base_url()?>staff/categories/edit/<?=$category['id']?>"><?=$category['name']?></a></td>
                <td><?=$category['title']?></td>
                <td><?=$category['description']?></td>
                <td><a href="<?=base_url()?>staff/categories/delete/<?=$category['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>