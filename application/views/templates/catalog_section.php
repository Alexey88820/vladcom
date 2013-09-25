<ol class="breadcrumb">
    <li><a href="<?=site_url()?>" title="Главная">Главная</a></li>
    <li><a href="<?=site_url('catalog')?>/" title="Каталог">Каталог</a></li>
    <li class="active"><?=$catalog_section->title?></li>
</ol>

<div class="h1"><?=$catalog_section->title?></div>

<?php // if (!empty($catalog_section->annotation)) : ?>
<!-- <div class=""> -->
    <?php // echo $catalog_section->annotation?>
<!-- </div> -->
<?php // endif; ?>

<div class="information-block">
<?php foreach ($catalog_groups as $group) : ?>
    <div class="catalog-group section-list">
        <a href="<?=site_url('catalog/' . $group->slug)?>/" title="<?=$group->title?>"><?=esc($group->title)?></a>
    </div>
<?php endforeach; ?>
</div>

<div class="information-block">
    <?=$catalog_section->body?>
</div>