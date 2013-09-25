<div class="leader-item">
    <div class="image">
        <a href="<?=$link?>" title="<?=$title?>">
            <img class="img-responsive" src="<?=$img?>" alt="<?=$title?>" title="<?=$title?>" />
        </a>
    </div>
    <div class="title">
        <a href="<?=$link?>" title="<?=$title?>"><?=$title?></a>
    </div>
    <div class="price"><?=convert_dollars_to_rubels($price, $course, 'r')?></div>
</div>