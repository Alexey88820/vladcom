<?php if (isset($hero_unit)) : ?>
    <div><?=$hero_unit->body?></div>
<?php endif; ?>

<?php foreach ($sections as $section) : ?>
    <div class="row information-block">
        <div class="row">
            <div class="col-xs-12">
                <h1><a href="<?=site_url('catalog/' . $section->slug)?>/" title="<?=$section->title?>"><?=esc($section->title)?></a></h1>
            </div>
        </div>
        <div class="col-xs-2">
            <a href="<?=site_url('catalog/' . $section->slug)?>/" title="<?=$section->title?>">
                <img class="img-responsive" src="<?=$section->img?>" alt="<?=$section->title?>" title="<?=$section->title?>">
            </a>
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

<div class="information-block">
    <?php if (isset($product_samples)) : ?>
        <div><?=$product_samples->body?></div>
    <?php endif; ?>
</div>

<div class="label-of-block">Последние публикации</div>
<?php if(count($recent_articles)): foreach($recent_articles as $article): ?>
    <div class="article-item information-block">
        <div class="title"><?=$article->title?></div>
        <div class="date"><?=date_mysql_to_ru_human($article->created)?></div>
        <div class="body"><?=$article->body?></div>
    </div>
<?php endforeach; endif; ?>
<div class="more-link">
    <small>
        <a href="<?=site_url('article') . '/'?>" title="Посмотреть все новости компании &laquo;Владком&raquo;">Архив публикаций</a>
    </small>
</div>
