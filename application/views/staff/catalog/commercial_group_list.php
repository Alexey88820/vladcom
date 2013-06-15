<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Раздел</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $value) { ?>
            <tr>
                <td><a href="<?=base_url()?>staff/catalog/edit/commercial_group/<?=$value['id']?>"><?=$value['title']?></a></td>
                <td><?=$value['section']?></td>
                <td><a href="<?=base_url()?>staff/catalog/delete/commercial_group/<?=$value['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>