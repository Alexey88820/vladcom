<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $section) { ?>
            <tr>
                <td><a href="<?=base_url()?>staff/catalog/edit/section/<?=$section['id']?>"><?=$section['name']?></a></td>
                <td><a href="<?=base_url()?>staff/catalog/delete/section/<?=$section['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>