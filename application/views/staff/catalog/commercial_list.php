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
                <td><a href="<?=base_url()?>staff/catalog/edit/commercial/<?=$section['id']?>"><?=$section['title']?></a></td>
                <td><a href="<?=base_url()?>staff/catalog/delete/commercial/<?=$section['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>