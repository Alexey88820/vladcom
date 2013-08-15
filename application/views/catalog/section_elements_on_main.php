<h4>Мы предлагаем:</h4>
<div class="sections-on-main element-border">
    <?php foreach ($content['blocks']['preview-sections'] as $key => $section) { ?>
        <div class="section-on-main">
            <div class="row-fluid">
                <div class="span2">
                    <img class="" src="/assets/pics/<?=$section['img']?>" alt="<?=$section['name']?>">
                </div>
                <div class="span10">
                    <h1><a href="<?=base_url()?>catalog/<?=$section['slug']?>" title="<?=$section['name']?>"><?=$section['name']?></a></h1>
                    <ul>
                        <?php foreach ($content['blocks']['preview-groups'][$section['id']] as $key => $group) { ?>
                        <?php
                        if (1==$group['invisible']) {
                            continue;
                        }
                        ?>
                            <li><a href="<?=base_url()?>catalog/<?=$group['slug']?>" title="<?=$group['name']?>"><?=$group['name']?></a></li>
                        <?php } ?>
                    </ul>
                    <div>
                        <?=$section['annotation']?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>