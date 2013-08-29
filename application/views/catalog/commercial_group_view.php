<h1><?=$content['commercial_group']['title']?></h1>
<div>
    <?=$content['commercial_group']['content']?>
</div>
<div class="row-fluid">
    <div class="span4">
        <img src="<?=base_url()?>assets/pics/comm-groups/<?=$content['commercial_group']['img']?>" alt="<?=$content['commercial_group']['title']?>">
    </div>
    <div class="span8">
        <table class="table table-bordered">
            <tbody>
            <?php foreach ($content['commercials'] as $item) { ?>
            <?php
            if ($item['comm_group']!=$content['commercial_group']['id']) {
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