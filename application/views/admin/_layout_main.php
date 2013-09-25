<?php $this->load->view('admin/components/page_head'); ?>
<body>
	<nav class="navbar navbar-default navbar-inverse" role="navigation">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	        <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>"><?=$meta_title?></a>
	  	</div>

	  	<!-- Collect the nav links, forms, and other content for toggling -->
	  	<div class="collapse navbar-collapse navbar-ex1-collapse">
	  		<ul class="nav navbar-nav">
		    	<li <?=$this->uri->segment(2) == 'dashboard' ? 'class="active"' : FALSE; ?>><a href="<?=site_url('admin/dashboard')?>">Главная</a></li>
		    	<li <?=$this->uri->segment(2) == 'news' ? 'class="active"' : FALSE; ?>><?=anchor('admin/news', 'Новости')?></li>
				<li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Каталог <b class="caret"></b></a>
		        	<ul class="dropdown-menu">
		          		<li <?=$this->uri->segment(2) == 'catalog_section' ? 'class="active"' : FALSE; ?>><?=anchor('admin/catalog_section', 'Секции')?></li>
		          		<li <?=$this->uri->segment(2) == 'catalog_group' ? 'class="active"' : FALSE; ?>><?=anchor('admin/catalog_group', 'Группы')?></li>
		          		<li <?=$this->uri->segment(2) == 'catalog_item' ? 'class="active"' : FALSE; ?>><?=anchor('admin/catalog_item', 'Товары')?></li>
		        	</ul>
		      	</li>
		    	<li <?=$this->uri->segment(2) == 'page' ? 'class="active"' : FALSE; ?>><?=anchor('admin/page', 'Страницы')?></li>
		    	<li <?=$this->uri->segment(2) == 'block' ? 'class="active"' : FALSE; ?>><?=anchor('admin/block', 'Блоки')?></li>
		    	<li <?=$this->uri->segment(2) == 'user' ? 'class="active"' : FALSE; ?>><?=anchor('admin/user', 'Пользователи')?></li>
	    	</ul>
	    	<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$this->session->userdata('username')?></a></li>
	    	    <li><a href="<?php echo site_url('admin/user/logout'); ?>"><span class="glyphicon glyphicon-off"></span> Выход</a></li>
	    	</ul>
	  	</div><!-- /.navbar-collapse -->
	</nav>

	<div class="container">

<?php $this->load->view($subview); ?>

	</div>

<?php $this->load->view('admin/components/page_tail'); ?>