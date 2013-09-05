<div>
    <h2>Карта сайта vladcom.su</h2>
    <ul>
    <?php foreach ($categories as $category) { ?>
        <li><a href="/<?=$category['name']?>/" title="<?=$category['description']?>"><?=$category['title']?></a></li>
        <?php if ($category['name']=='catalog') { ?>
            <ul>
            <?php foreach ($catalog['sections'] as $section) { ?>
                    <li><a href="<?=base_url()?>catalog/<?=$section['slug']?>/" title="Подробнее. <?=$section['name']?>"><?=$section['name']?></a></li>
                    <?php foreach ($catalog['groups'] as $group) { ?>
                        <?php
                        if ($group['section'] != $section['id']) {
                            continue;
                        }
                        ?>
                        <?php if (10==$group['id']) { ?>
                            <li><a href="<?=base_url()?>catalog/<?=$group['slug']?>/" title="Подробнее. <?=$group['name']?>"><?=$group['name']?></a></li>
                                <ul>
                                <?php foreach ($catalog['commercial_groups'] as $commercial_group) { ?>
                                    <li><a href="<?=base_url()?>catalog/<?=$commercial_group['slug']?>/" title="Подробнее. <?=$commercial_group['title']?>"><?=$commercial_group['title']?></a></li>
                                    <ul>
                                        <?php foreach ($catalog['commercials'] as $item) { ?>
                                        <?php
                                        if ($item['comm_group']!=$commercial_group['id']) {
                                            continue;
                                        }
                                        ?>
                                        <li><a href="<?=base_url()?>catalog/<?=$item['slug']?>/" title="Подробнее. <?=$item['title']?>"><?=$item['title']?></a></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                </ul>
                                <?php continue; ?>
                        <?php } ?>

                            <li><a href="<?=base_url()?>catalog/<?=$group['slug']?>/" title="Подробнее. <?=$group['name']?>"><?=$group['name']?></a></li>
                            <ul>
                            <?php foreach ($catalog['items'] as $item) { ?>
                                <?php if ($item['group'] != $group['id']) {
                                    continue;
                                } ?>
                                <li><a href="<?=base_url()?>catalog/<?=$item['slug']?>/" title="Подробнее. <?=$item['name']?>"><?=$item['name']?></a></li>
                            <?php } ?>
                            </ul>
                    <?php } ?>
            <?php } ?>
            </ul>
        <?php } ?>
    <?php } ?>
        <li><a href="/news/" title="Новости компании &quot;Владком&quot;">Новости компании</a></li>
    </ul>
</div>

