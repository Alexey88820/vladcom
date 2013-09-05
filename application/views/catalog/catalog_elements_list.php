<?php foreach ($content['items'] as $item) { ?>
    <div>
        <a href="<?=base_url()?>catalog/<?=$item['slug']?>/" title="Подробности. <?=$item['name']?>"><?=$item['name']?></a>
    </div>
<?php } ?>