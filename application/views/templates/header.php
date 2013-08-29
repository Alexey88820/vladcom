
    <div class="masthead">
        <div class="row-fluid header">
            <div class="span9">
                <div class="header-logo">
                <div class="logo1">
                    <a class="brand white-color" href="<?=base_url()?>" title="Владком. Оборудование для порошковой окраски. Оборудование для обработки метала.">Владком</a>
                </div>
                <div class="logo2 white-color">Производственно-торговая компания</div>
                <div class="header-description white-color">
                    <p>Компания «ВладКом» — это проектно-производственное предприятие, которое имеет в своем составе конструкторское бюро, производственные площади с современным оборудованием и офис продаж в г. Чебоксары.</p>
                    <p>Наши специалисты помогут вам подготовить техническое задание, разработать и согласовать проект, проведут монтаж оборудования, его пуско-наладку и должным образом обучат ваш персонал.</p>
                </div>
                </div>
            </div>
            <div class="span3 header-contacts">
                    <div class="pull-right nav-contacts">
                        <p class="contact-p"><?=$header['phone1']?></p>
                        <p class="contact-p"><?=$header['phone2']?></p>
                        <p class="contact-p"><?=$header['phone3']?></p>
                        <!-- <p class="contact-city">респ. Чувашия, г. Чебоксары</p> -->
                        <p class="contact-email">
                            <a href="mailto:<?=$header['email']?>" title="Написать письмо">
                                <?=$header['email']?>
                            </a>
                        </p>
                    </div>
            </div>
        </div>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <?php foreach ($nav as $nav_item) { ?>
                        <?php if ($nav_item['active']===TRUE) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }?>
                        <li class="<?=$active?>">
                            <a href="<?=base_url()?><?=(!empty($nav_item['name'])) ? $nav_item['name'] . '/' : ''?>" title="<?=$nav_item['description']?>">
                                <?=$nav_item['title']?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<div class="container-fluid">
    <div class="row-fluid">
