<div class="blank">
    <h1 class="h-style">Публикации</h1>
    <?php if(count($articles)): foreach($articles as $article): ?>
    <div class="article-item">
        <div class="title"><?=$article->title?></div>
        <div class="date"><?=date_mysql_to_ru_human($article->created)?></div>
        <div class="body"><?=$article->body?></div>
    </div>
    <?php endforeach; endif; ?>
</div>