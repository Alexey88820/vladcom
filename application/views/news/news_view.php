<h4>Новости компании</h4>
<?php foreach ($content['news'] as $news_item) { ?>
    <div class="main-news-block">
        <div class="main-news-title"><?=$news_item['header']?></div>
        <div class="main-news-date"><?=date_mysql_to_ru_human($news_item['create_date'])?></div>
        <div class="main-news-text"><?=$news_item['text']?></div>
    </div>
<?php } ?>