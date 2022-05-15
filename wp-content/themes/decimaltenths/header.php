<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- <link rel="preconnect" href="https://www.googletagmanager.com"> -->
	<!-- Google Tag Manager script here... -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<?php //get_template_part( 'template-parts/head-icons' ); ?>

	<!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
	<!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet"> -->

	<?php /* Critical CSS */ ?>
	<style type="text/css">
	/* Critical CSS */
	<?php //echo file_get_contents( get_template_directory_uri() . '/dist/css/critical.css' ); ?>
	</style>

	<!-- wp_head -->	
	<?php wp_head(); ?>

	<?php /* Critical JS */ ?>
	<script type="text/javascript">
	/* Critical JS */
	<?php //echo file_get_contents( get_template_directory_uri() . '/dist/js/app.js' ); ?>
	</script>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) here... -->

<header class="header" role="banner">
	{HEADER}
</header>

<div class="bo-content">