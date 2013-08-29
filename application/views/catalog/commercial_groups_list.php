<?php foreach ($content['commercial_groups'] as $group) { ?>
    <h1><a href="<?=base_url()?>catalog/<?=$group['slug']?>/" title="<?=$group['title']?>"><?=$group['title']?></a></h1>
    <div class="row-fluid">
        <div class="span4">
            <img src="<?=base_url()?>assets/pics/comm-groups/<?=$group['img']?>" alt="<?=$group['title']?>">
        </div>
        <div class="span8">
            <table class="table table-bordered">
                <tbody>
                <?php foreach ($content['commercials'] as $item) { ?>
                <?php
                if ($item['comm_group']!=$group['id']) {
                    continue;
                }
                ?>
                <tr>
                    <td><a href="<?=base_url()?>catalog/<?=$item['slug']?>/" title="Подробности. <?=$item['title']?>"><?=$item['title']?></a></td>
                    <td class="td-price"><?=convertDollarToRubel($item['price'], $course)?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>