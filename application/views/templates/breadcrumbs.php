<?php if (isset($breadcrumbs)) { ?>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $level) { ?>
                <?php
                if ($level['link']==FALSE) { ?>
                    <li class="active"><?=$level['name']?> <span class="divider">/</span></li>
                <?php } else { ?>
                    <li><a href="<?=$level['link']?>" title="<?=$level['name']?>"><?=$level['name']?></a> <span class="divider">/</span></li>
                <?php } ?>
            <?php } ?>
        </ul>
<?php } ?>