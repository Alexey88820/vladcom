<div>
    <?php foreach ($content['sections'] as $section) { ?>
        <div>
            <h2 class="section-toggle"><a href="<?=base_url()?>catalog/<?=$section['slug']?>" title="Подробнее. <?=$section['name']?>"><?=$section['name']?></a></h2>
            <div class="section-content">
            <?php foreach ($content['groups'] as $group) { ?>

                <?php
                if ($group['section'] != $section['id']) {
                    continue;
                }
                ?>
                <?php //Показываем готовые окрасочные комплексы в коммерческих предложениях ?>
                <?php if (10==$group['id']) { ?>
                    <h3><a href="<?=base_url()?>catalog/<?=$group['slug']?>" title="Подробнее. <?=$group['name']?>"><?=$group['name']?></a></h3>
                    <?php foreach ($content['commercial_groups'] as $commercial_group) { ?>
                        <h4><a href="<?=base_url()?>catalog/<?=$commercial_group['slug']?>" title="Подробнее. <?=$commercial_group['title']?>"><?=$commercial_group['title']?></a></h4>
                        <div>
                            <div>
                                <table class="table">
                                    <tbody>
                                    <?php foreach ($content['commercials'] as $item) { ?>
                                    <?php
                                    if ($item['comm_group']!=$commercial_group['id']) {
                                        continue;
                                    }
                                    ?>
                                    <tr>
                                        <td><a href="<?=base_url()?>catalog/<?=$item['slug']?>" title="Подробнее. <?=$item['title']?>"><?=$item['title']?></a></td>
                                        <td class="td-price"><?=convertDollarToRubel($item['price'], $course)?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                    <?php continue; ?>
                <?php } ?>
                <div>
                    <h3><a href="<?=base_url()?>catalog/<?=$group['slug']?>" title="Подробнее. <?=$group['name']?>"><?=$group['name']?></a></h3>
                    <table class="table">
                    <?php foreach ($content['items'] as $item) { ?>
                        <?php if ($item['group'] != $group['id']) {
                            continue;
                        } ?>
                        <tr class="show-more">
                            <td><span class="link" title="Подробнее. <?=$item['name']?>"><?=$item['name']?></span></td>
                            <td class="td-price"><?=convertDollarToRubel($item['price'], $course)?></td>
                        </tr>
                        <tr class="more">
                            <td colspan="2"><?=$item['description']?></td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>
            <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>