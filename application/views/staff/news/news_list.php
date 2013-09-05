<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_values as $news_item) { ?>
            <tr>
                <td><a href="<?php echo base_url(); ?>staff/news/edit/<?=$news_item['id']?>"><?=$news_item['header']?></a></td>
                <td><?=$news_item['create_date']?></td>
                <td><a href="<?php echo base_url(); ?>staff/news/delete/<?=$news_item['id']?>">x</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>