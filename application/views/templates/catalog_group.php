<ol class="breadcrumb">
    <li><a href="<?=site_url()?>" title="Главная">Главная</a></li>
    <li><a href="<?=site_url('catalog')?>/" title="Каталог">Каталог</a></li>
    <li><a href="<?=site_url('catalog/' . $catalog_section->slug)?>/" title="<?=$catalog_section->title?>"><?=$catalog_section->title?></a></li>
    <li class="active"><?=$catalog_group->title?></li>
</ol>

<div class="h1"><?=$catalog_group->title?></div>

<?php if (!empty($catalog_group->annotation)) : ?>
<div class="information-block">
    <?=$catalog_group->annotation?>
</div>
<?php endif; ?>

<div class="information-block catalog-items">
    <?php if (count($catalog_items)) : ?>
    <table class="table table-striped">
        <?php foreach ($catalog_items as $item) : ?>
            <tr>
                <td>
                    <?php
                    $a_class = '';
                    if ($item->ajax_group == 1) {
                        $a_class = 'item-more-link';
                    } ?>
                    <a class="<?=$a_class?>" href="<?=site_url('catalog/' . $item->slug)?>/" title="<?=$item->title?>"><?=esc($item->title)?></a>
                    <?php if ($item->ajax_group == 1) : ?>
                    <div class="item-more-content">
                        <div>Дополнительная информация:</div>
                        <?=$item->body?>
                    </div>
                    <?php endif; ?>
                </td>
                <td class="price">
                    <?=convert_dollars_to_rubels($item->price, $course)?>
                </td>
<!--                 <td>
                    Заказать
                </td> -->
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>

<div class="information-block">
    <?=$catalog_group->body?>
</div>