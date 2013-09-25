<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title><?php echo $meta_title; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo site_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
	<link href="<?php echo site_url('assets/css/styles.css') . '?css=' . time()  ?>" rel="stylesheet" media="screen">

    <link rel="icon" href="<?=site_url('favicon.ico')?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?=site_url('favicon.ico')?>" type="image/x-icon">

    <?php if (isset($canonical)) : ?>
    <link rel="canonical" href="<?=$canonical?>"/>
    <?php endif; ?>

    <?php if (empty($meta_index)) : ?>
    <meta name="robots" content="none"/>
    <?php endif; ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?=$meta_description?>" />
    <meta name="keywords" content="<?=$meta_keywords?>" />

</head>