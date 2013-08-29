<?php foreach ($content['sections'] as $section) { ?>
    <h4>
        <a href="<?=base_url()?>catalog/<?=$section['slug']?>/" title="<?=$section['name']?>"><?=$section['name']?></a>
    </h4>
<?php } ?>