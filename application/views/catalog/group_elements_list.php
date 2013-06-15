<div>
    <h2><?=$content['section']['name']?></h2>
        <ul>
        <?php foreach ($content['groups'] as $group) { ?>
            <li>
                <a href="<?=base_url()?>catalog/<?=$group['slug']?>" title="<?=$group['name']?>"><?=$group['name']?></a>
            </li>
        <?php } ?>
        </ul>

    <div><?=$content['section']['description']?></div>
</div>

