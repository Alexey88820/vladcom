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
                <td><a href="<?=base_url()?>staff/catalog/edit/group/<?=$value['id']?>"><?=$value['name']?></a></td>
                <!-- <td><?=$value['description']?></td> -->
                <td><?=$value['section']?></td>
                <td><a href="<?=base_url()?>staff/catalog/delete/group/<?=$value['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>