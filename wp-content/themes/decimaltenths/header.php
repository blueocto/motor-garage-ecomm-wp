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
	
	<div id="site-navigation" class="header--inner">

		<p class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
				<span class="visuallyhidden"><?php bloginfo( 'name' ); ?></span>
				<img src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/logo-duotone.svg'; ?>" alt="Decimal Tenths logo" loading="eager" width="300" height="53" />
			</a>
		</p>
		
		<p class="a11y-skip"><a href="#main">Skip to Content</a></p>
		
		<?php /* Menu trigger for small devices */ ?>	
		<div class="menu-button-container">
			<button id="primary-mobile-menu" class="menu-button-trigger" aria-controls="primary-menu-list" aria-expanded="false">
				<span class="dropdown-icon open">
					<?php get_template_part( 'template-parts/svg/bars-light' ); ?>
					<?php esc_html_e( 'Menu', 'blueocto-2022' ); ?>
				</span>
				<span class="dropdown-icon close">
					<?php get_template_part( 'template-parts/svg/xmark-light' ); ?>
					<?php esc_html_e( 'Close', 'blueocto-2022' ); ?>
				</span>
			</button>
		</div>

		<?php //octopress_primary_nav(); ?>

		<?php get_template_part( 'template-parts/dropdown-menu' ); ?>

		<div class="header--shop-links">
			<?php get_search_form(); ?>
			<p class="menu-item">
				<a href="/my-account/">
					<span class="visuallyhidden">Account</span>
					<?php get_template_part( 'template-parts/svg/user-light' ); ?>
				</a>
			</p>
			<p class="menu-item">
				<a href="/basket/">
					<span class="visuallyhidden">Cart</span>
					<?php get_template_part( 'template-parts/svg/cart-shopping-light' ); ?>
					<span class="basket-quantity">
						<?php global $woocommerce; echo $woocommerce->cart->cart_contents_count; ?>
					</span>
				</a>
			</p>
		</div>

	</div>
</header><!-- // header -->

<div class="bo-content">