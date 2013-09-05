<!-- <a class="btn btn-success" href="<?=base_url()?>/staff/catalog/create/">Типы изделий</a> -->
<table class="table">
    <thead>
        <tr>
            <th>Название товара</th>
            <th>Алиас</th>
            <th>Цена</th>
            <th>Группа</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $value) { ?>
            <tr>
                <td><a href="<?php echo base_url(); ?>staff/catalog/edit/catalog/<?=$value['id']?>"><?=$value['name']?></a></td>
                <td><?=$value['slug']?></td>
                <td><?=$value['price']?></td>
                <td><?=$value['group']?></td>
                <td><?=$value['create_date']?></td>
                <td><a href="<?php echo base_url(); ?>staff/catalog/delete/catalog/<?=$value['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>