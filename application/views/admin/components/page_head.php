<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $meta_title; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('assets/css/admin.css'); ?>" rel="stylesheet">

	<script src="<?php echo site_url('assets/js/jquery-2.0.3.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>

	<?php if(isset($sortable) && $sortable === TRUE): ?>
		<script src="<?php echo site_url('assets/js/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.mjs.nestedSortable.js'); ?>"></script>
	<?php endif; ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- TinyMCE -->
    <script type="text/javascript" src="<?=site_url('assets/js/tinymce/tinymce.min.js'); ?>"></script>
    <script type="text/javascript">
		tinymce.init({
			mode : "specific_textareas",
			editor_selector : "tinymce",
        	editor_deselector : "no-tinymce",

        	content_css : "/assets/css/bootstrap.min.css, /assets/css/styles.css",

		    plugins: [
		      "advlist autolink lists link image charmap print preview anchor",
		      "searchreplace visualblocks code fullscreen",
		      "textcolor",
		      "insertdatetime media table contextmenu paste jbimages"
		    ],

			toolbar: "insertfile undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | code",

			relative_urls: false

		});
    </script>
    <!-- /TinyMCE -->
</head>