<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- <link rel="preconnect" href="https://www.googletagmanager.com"> -->
	<!-- Google Tag Manager script here... -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<?php //get_template_part( 'template-parts/head-icons' ); ?>

	<?php /* FONTS */ ?>
	<link rel="stylesheet" href="https://use.typekit.net/pbr8cho.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,600;1,600&display=swap" rel="stylesheet">

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
	<p class="logo">
		<a href="#">Decimal Tenths</a>
	</p>
	
	<p class="a11y-skip"><a href="#main">Skip to Content</a></p>

	<div id="site-navigation" class="header--inner">
	<?php /* Menu trigger for small devices */ ?>	
		<div class="menu-button-container">
			<button id="primary-mobile-menu" class="menu-button-trigger" aria-controls="primary-menu-list" aria-expanded="false">
				<span class="dropdown-icon open">
					<?php get_template_part( 'template-parts/svg/icon-menu' ); ?>
					<?php esc_html_e( 'Menu', 'blueocto-2022' ); ?>
				</span>
				<span class="dropdown-icon close">
					<?php get_template_part( 'template-parts/svg/icon-close' ); ?>
					<?php esc_html_e( 'Close', 'blueocto-2022' ); ?>
				</span>
			</button>
		</div>
	</div>

	<nav class="primary-nav">
		<ul class="primary-menu">
			<li><a href="#">Home</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">VAG</a></li>
			<li><a href="#">Shop</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</nav>

	<div class="header--shop-links">
		<p><a href="#">Cart</a></p>
		<p><a href="">Account</a></p>
		<p><a href="">Search</a></p>
	</div>
</header>

<div class="bo-content">