<div>
    <div class="main-news element-border">
        <h4>Новости компании</h4>
        <?php foreach ($content['blocks']['preview-news'] as $news_item) { ?>
            <div class="main-news-block">
                <div class="main-news-title"><?=$news_item['header']?></div>
                <div class="main-news-date"><?=date_mysql_to_ru_human($news_item['create_date'])?></div>
                <div class="main-news-text"><?=$news_item['text']?></div>
            </div>
        <?php } ?>
        <div class="news-more">
            <a href="<?=base_url()?>news/" title="Новости компании &quot;Владком&quot;">Архив новостей</a>
        </div>
    </div>
</div>