<table class="table">
    <thead>
        <tr>
            <th>Название блока</th>
            <th>Краткое описание</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $block_item) { ?>
            <tr>
                <td><a href="<?=base_url()?>staff/blocks/edit/<?=$block_item['id']?>/"><?=$block_item['name']?></a></td>
                <td><?=$block_item['description']?></td>
                <td><a href="<?=base_url()?>staff/blocks/delete/<?=$block_item['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>