<?php $this->load->view('components/page_head');?>

<body>

<header>
    <?=$header->body?>
</header>

<div class="container navigation-bar">
    <div class="navbar navbar-default" role="navigation">
        <div class="collapse navbar-collapse">
            <?php echo get_menu($menu); ?>
        </div>
    </div>
</div>

<div class="container content">
    <div class="row">
        <div class="col-xs-2 sidebar">
            <div class="label-of-block">
                Наша продукция
            </div>
            <?php echo get_sidebar($sections, $groups)?>
        </div>

        <div class="col-xs-8 content-on-main">
            <?php $this->load->view('templates/' . $subview); ?>
        </div>

        <div class="col-xs-2 leaders">
            <div class="label-of-block">
                Лидеры продаж
            </div>
            <?php foreach ($leaders as $leader) : ?>
                <?php $this->load->view('templates/_leader',
                    array(
                        'img'    => site_url($leader->img),
                        'link'   => site_url('catalog/' . $leader->slug) . '/',
                        'title'  => $leader->title,
                        'price'  => $leader->price,
                        'course' => $course,
                    )
                )?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<footer>
    <?=$footer->body?>
</footer>

<?php $this->load->view('components/page_tail');?>