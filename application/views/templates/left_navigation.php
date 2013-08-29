<div class="span2 left-nav">
    <ul class="nav">
        <?php foreach ($left_nav['sections'] as $section): ?>
        <?php
        $active = $section['slug'] == $this->uri->segment(2) ? TRUE : FALSE;
        $li = $active ? '<li class="active">' : '<li>';
        ?>
            <?=$li?>
                <a href="/catalog/<?=$section['slug']?>/" title="<?=$section['name']?>"><?=$section['name']?></a>
                <ul class="nav">
                    <?php foreach ($left_nav['groups'][$section['id']] as $group) { ?>
                    <?php
                    $active = $group['slug'] == $this->uri->segment(2) ? TRUE : FALSE;
                    $li = $active ? '<li class="active">' : '<li>';
                    ?>
                    <?php
                    if (1==$group['invisible']) {
                        continue;
                    }
                    ?>
                        <?=$li?>
                            <a href="<?=base_url()?>catalog/<?=$group['slug']?>/" title="<?=$group['name']?>"><?=$group['name']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

