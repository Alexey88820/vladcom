<div class="category-block block-content-pr-pl">
    <h1>Ошибка 404</h1>
    <?php
        // var_dump($nav);
    ?>
    <div>
        <p>Страница, которую вы запросили, не найдена. Вполне возможно, что ее вообще не существует. Поэтому убедительно просим вас проверить правильность написания адреса. Или выбрать нужный вам раздел:</p>
        <ul>
            <?php foreach ($categories as $value) { ?>
                <?php
                    if ($value['name']=='main') {
                        $value['name'] = '';
                    }
                ?>
                <li><a href="<?=base_url()?><?=$value['name']?>" title="<?=$value['description']?>"><?=$value['title']?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>