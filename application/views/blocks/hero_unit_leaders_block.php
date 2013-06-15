<div class="span2">
    <div class="leaders element-border">
        <div class="leaders-block-header">Лидеры продаж:</div>
        <div class="leaders-block">
        <?php foreach ($content['leaders'] as $leader) { ?>
            <div class="leader-item">

                <div class="leader-img-block">
                    <a href="/catalog/<?=$leader['slug']?>" title="<?=$leader['name']?>">
                        <img class="leader-img" src="/assets/pics/<?=$leader['img']?>" alt="<?=$leader['name']?>">
                    </a>
                </div>
                <p>
                    <a href="/catalog/<?=$leader['slug']?>" title="<?=$leader['name']?> за <?=convertDollarToRubel($leader['price'], $course, 'r')?>"><?=$leader['name']?></a>
                <p>
                <p class="leader-price">
                    <?=convertDollarToRubel($leader['price'], $course, 'r')?>
                </p>
            </div>
        <?php } ?>
        </div>
    </div>
</div>