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
	
	<?php get_template_part( 'template-parts/site-logo' ); ?>
	
	<p class="a11y-skip"><a href="#main">Skip to Content</a></p>

	<div id="site-navigation" class="header--inner">
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

		<?php octopress_primary_nav(); ?>

		<ul id="primary-menu-list" class="menu primary--menu">
			<li id="menu-item-157770" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-6749 current_page_item menu-item-157770">
				<a href="https://decimal.blueocto.dev/" aria-current="page">Home</a>
			</li>
			<?php /* START Shop By Car */ ?>
			<li id="menu-item-157805" class="level-1 menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-157805"><a href="#">Shop By Car</a><button class="sub-menu-toggle" aria-expanded="false" onclick="twentytwentyoneExpandSubMenu(this)"><span class="visuallyhidden">Open menu</span></button>
				<?php octopress_shopbycar_nav(); ?>
			</li>
			<?php /* END Shop By Car */ ?>
			<?php /* START Shop By Part */ ?>
			<li id="menu-item-157806" class="level-1 menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-157806"><a href="#">Shop By Part</a><button class="sub-menu-toggle" aria-expanded="false" onclick="twentytwentyoneExpandSubMenu(this)"><span class="visuallyhidden">Open menu</span></button>
				<?php octopress_shopbypart_nav(); ?>
			</li>
			<?php /* END Shop By Car */ ?>
			<li id="menu-item-157771" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157771">
				<a href="https://decimal.blueocto.dev/about-us/">About Us</a>
			</li>
			<li id="menu-item-157773" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157773">
				<a href="https://decimal.blueocto.dev/contact-us/">Contact Us</a>
			</li>
		</ul>



		<div class="header--shop-links">
			<p class="menu-item"><a href="/basket/">Cart <?php get_template_part( 'template-parts/svg/cart-shopping-light' ); ?></a></p>
			<p class="menu-item"><a href="/my-account/">Account <?php get_template_part( 'template-parts/svg/user-light' ); ?></a></p>
			<p class="menu-item"><a href="">Search <?php get_template_part( 'template-parts/svg/magnifying-glass-light' ); ?></a></p>
		</div>

	</div>
</header><!-- // header -->

<div class="bo-content">

<section>
	<div class="row">
		<div class="column small-12 large-6">
			<p>{img}</p>
		</div>
		<div class="column small-12 large-6">
			<h1><span>Welcome to</span> Decimal Tenths</h1>
			<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit fuis  ultrices nunc. Cras id quam non odio egestas cursus nisi. Suspendisse potenti norbi a tristique.</h2>
			<p>Suspendisse iaculis auctor nunc a auctor. Duis molestie tellus enim, quis ultricies ante euismod a. Vestibulum arcu quam, rhoncus nec nisl vitae, dictum lobortis libero. Vestibulum ac risus leo. Curabitur ullamcorper volutpat tortor at dictum. In sagittis sit amet nisl convallis tempor. Mauris consectetur eget urna vitae egestas. Aliquam a augue sodales, mattis lacus gravida, lacinia ante.</p>
			<p>Aliquam bibendum, quam sed sagittis vulputate, risus neque commodo ante, id tempor dolor nulla eu eros. Cras tortor sem, molestie vitae enim vel, scelerisque auctor nulla.</p>
			<p>
				<a class="btn" href="#">Learn More</a>
			</p>
		</div>
	</div>
</section>

<section>
	<p>Search by car</p>
	<form>
		<select>
			<option value="">--Choose Your Manufacturer--</option>
			<option value="">Audi</option>
			<option value="">SEAT</option>
			<option value="">Skoda</option>
			<option value="">Volkswagen</option>
		</select>
		<select>
			<option value="">--Model--</option>
			<option value="">Amarok</option>
			<option value="">Arteon</option>
			<option value="">Golf</option>
			<option value="">Yeti</option>
		</select>
		<input type="submit" value="Submit">
	</form>
</section>

<section>
	<h2><span>Shop our</span> Latest Products</h2>
	<div class="row">
		<div class="column small-12 large-3">
			<div class="product">
				<p>{img}</p>
				<h3>ARP Crankshaft Bolt</h3>
				<p>&pound;60.00</p>
				<p><a class="btn" href="#">Add To Cart</p>
			</div>
		</div>
		<div class="column small-12 large-3">
			<div class="product">
				<p>{img}</p>
				<h3>ARP Crankshaft Bolt</h3>
				<p>&pound;60.00</p>
				<p><a class="btn" href="#">Add To Cart</p>
			</div>
		</div>
		<div class="column small-12 large-3">
			<div class="product">
				<p>{img}</p>
				<h3>ARP Crankshaft Bolt</h3>
				<p>&pound;60.00</p>
				<p><a class="btn" href="#">Add To Cart</p>
			</div>
		</div>
		<div class="column small-12 large-3">
			<div class="product">
				<p>{img}</p>
				<h3>ARP Crankshaft Bolt</h3>
				<p>&pound;60.00</p>
				<p><a class="btn" href="#">Add To Cart</p>
			</div>
		</div>
	</div>
</section>

<section style="display:flex;" class="column">
	<!-- <div class="row"> -->
		<div class="column large-fifth">
			<p>{ico}</p>
			<h3>Servicing</h3>
			<p>Lorem ipsum dolor sit amet porti elit consectetur adipisc elit imi surabitur vestibulum rhindus.</p>
			<p><a href="#">Discover</a></p>
		</div>
		<div class="column large-fifth">
			<p>{ico}</p>
			<h3>Servicing</h3>
			<p>Lorem ipsum dolor sit amet porti elit consectetur adipisc elit imi surabitur vestibulum rhindus.</p>
			<p><a href="#">Discover</a></p>
		</div>
		<div class="column small-12 large-fifth">
			<p>{ico}</p>
			<h3>Servicing</h3>
			<p>Lorem ipsum dolor sit amet porti elit consectetur adipisc elit imi surabitur vestibulum rhindus.</p>
			<p><a href="#">Discover</a></p>
		</div>
		<div class="column small-12 large-fifth">
			<p>{ico}</p>
			<h3>Servicing</h3>
			<p>Lorem ipsum dolor sit amet porti elit consectetur adipisc elit imi surabitur vestibulum rhindus.</p>
			<p><a href="#">Discover</a></p>
		</div>
		<div class="column small-12 large-fifth">
			<p>{ico}</p>
			<h3>Servicing</h3>
			<p>Lorem ipsum dolor sit amet porti elit consectetur adipisc elit imi surabitur vestibulum rhindus.</p>
			<p><a href="#">Discover</a></p>
		</div>
	<!-- </div> -->
</section>

<section class="row">
	<div class="column small-12">
		<h2><span>Engine Services</span> Custom Tuning</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisc elit. Curabitur vestibulum purus sed porta biben dumresi donec rhoncus enim nisl.</p>
		<p><a class="btn btn-outline" href="#">Discover</a></p>
	</div>
</section>

<section>
	<h2><span>Check out our</span> YouTube Channel&hellip;</h2>
	<div class="row">
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
		<div class="column small-12 large-2">
			<p>{video clip}</p>
			<h3>VIS Motorsport Balance Sh..</h3>
			<p>11/02/2022</p>
			<p>In this video I tackle the MK5 GTI track car engine, with a Vis...</p>
			<p><strong>3.8K Views &bull; 216 Likes</strong></p>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="column small-12 large-expand">
			<p>{ico}</p>
			<h4>Decimal Tenths</h4>
			<p><strong>8.1k Subscribers &bull; 112 Videos &bull; 642k Views</p>
			<p><em>Track Cars, Engine Builds, Witty Banter&hellip; OK mybe not the last one&hellip;</p>
		</div>
		<div class="column small-12">
			<p><a class="btn btn-outline" href="#">Visit our channel!</a></p>
		</div>
	</div>
</section>

<section class="row">
	<div class="column small-12">
		<h2>Testimonials</h2>
		<h3>What our customers say&hellip;</h3>
		<p>Suspendisse iaculis auctor nunc a auctor. Duis molestie tellus enim, quis ultricies ante euismod a. Vestibulum arcu quam, rhoncus nec nisl vitae, dictum lobortis libero. Vestibulum ac risus leo. Curabitur ullamcorper volutpat tortor at dictum. In sagittis sit amet nisl convallis tempor. Mauris consectetur eget urna vitae egestas. Aliquam a augue sodales, mattis lacus gravida, lacinia ante.</p>
		<p>Aliquam bibendum, quam sed sagittis vulputate, risus neque commodo ante, id tempor dolor nulla eu eros. Cras tortor sem, molestie vitae enim vel, scelerisque auctor nulla.</p>
		<p><strong><em>Jake Smith, Durham</em></strong></p>
	</div>
</section>

<section>
	<div class="row">
		<div class="column small-12 large-6">
			<h2><span>Contact</span><h2>
			<h3>Get in touch with us</h3>
			<p>Based in Blaydon On Tyne, Serving the whole of the North East, Northumberland, Newcastle, Gateshead, Durham, Teeside, Tyne And Wear and in fact…..the rest of the UK.</p>
			<p>Great Products, Great Prices, Great Banter…. Aye…. First two anyway.</p>
			<p>Fancy a trip out?… Low on Coffee?… Visit us at:</p>
			<p><strong>Decimal Tenths, Unit 8, Imperial Business Park, Factory Road, Blaydon On Tyne, NE21 5SA</strong></p>
			<p><a class="btn" href="#">Send a message</p>
		</div>
		<div class="column small-12 large-6">
			<p>{img}</p>
		</div>
	</div>
</section>