<ol class="breadcrumb">
    <li><a href="<?=site_url()?>" title="Главная">Главная</a></li>
    <li class="active">Каталог</li>
</ol>

<?php foreach ($sections as $section) : ?>
    <div class="row information-block">
        <div class="row">
            <div class="col-xs-12">
                <h1><a href="<?=site_url('catalog/' . $section->slug)?>/" title="<?=$section->title?>"><?=esc($section->title)?></a></h1>
            </div>
        </div>
        <div class="col-xs-2">
            <img class="img-responsive" src="<?=$section->img?>" alt="<?=$section->title?>">
        </div>
        <div class="col-xs-10">
            <div class="annotation">
                <?=$section->annotation?>
            </div>
            <?php if (count($groups)) : ?>
            <div>
                <?php foreach ($groups as $group) : ?>
                    <?php if ($group->section_id != $section->id) continue; ?>
                    <div class="catalog-group">
                        <a href="<?=site_url('catalog/' . $group->slug)?>/" title="Перейти в раздел &laquo;<?=$group->title?>&raquo;"><?=esc($group->title)?></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
                <div class="more-link">
                    <small>
                        <a href="<?=site_url('catalog/' . $section->slug)?>/" title="Перейти в раздел &laquo;<?=$section->title?>&raquo;">Перейти в раздел &laquo;<?=esc($section->title)?>&raquo;</a>
                    </small>
                </div>
        </div>
    </div>
<?php endforeach; ?>