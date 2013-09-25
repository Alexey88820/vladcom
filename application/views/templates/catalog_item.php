<ol class="breadcrumb">
    <li><a href="<?=site_url()?>" title="Главная">Главная</a></li>
    <li><a href="<?=site_url('catalog')?>/" title="Каталог">Каталог</a></li>
    <li><a href="<?=site_url('catalog/' . $catalog_section->slug)?>/" title="<?=$catalog_section->title?>"><?=$catalog_section->title?></a></li>
    <li><a href="<?=site_url('catalog/' . $catalog_group->slug)?>/" title="<?=$catalog_group->title?>"><?=$catalog_group->title?></a></li>
    <li class="active"><?=$catalog_item->title?></li>
</ol>

<h1><?=$catalog_item->title?></h1>
<div class="information-block catalog-item">
    Цена: <span class="price"><?=convert_dollars_to_rubels($catalog_item->price, $course)?></span>
</div>

<div class="information-block">
    <?=$catalog_item->body?>
</div>

<div class="information-block">
    <?=$catalog_group->body?>
</div>
