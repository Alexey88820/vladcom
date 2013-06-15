<div>
    <div class="row-fluid">
        <div class="span8"><h3><?=$content['item']['name']?></h3></div>
        <div class="span4"><h3 class="p-price"><?=convertDollarToRubel($content['item']['price'], $course, 'r')?></h3></div>
    </div>

    <div><?=$content['item']['description']?></div>
    <div><?=$content['group']['description']?></div>
</div>