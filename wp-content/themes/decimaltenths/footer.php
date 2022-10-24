	<footer class="footer" role="contentinfo">

		<div class="row">
			<div class="column small-12 medium-6 xlarge-3">
				<p class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
						<span class="visuallyhidden"><?php bloginfo( 'name' ); ?></span>
						<img src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/logo-black.svg'; ?>" alt="Decimal Tenths logo" loading="lazy" />
					</a>
				</p>
			</div>
			<div class="column small-12 medium-6 xlarge-3">
				<h3 class="h4">Shop</h3>
				<nav>
					<?php octopress_footer_nav_a(); ?>
				</nav>
			</div>
			<div class="column small-12 medium-6 xlarge-3">
				<h3 class="h4">Menu</h3>
				<nav>
					<?php octopress_footer_nav_b(); ?>
				</nav>
			</div>
			<div class="column small-12 medium-6 xlarge-3">
				<h3 class="h4">Social</h3>
				<nav>
					<ul class="menu footer--menu">
						<li class="menu-item"><a href="https://www.youtube.com/channel/UCIipR1T51cr5fsfCSRX_kgA" target="_blank" rel="noopener noreferrer">YouTube</a></li>
						<li class="menu-item"><a href="https://www.facebook.com/decimaltenths" target="_blank" rel="noopener noreferrer">Facebook</a></li>
						<li class="menu-item"><a href="https://www.instagram.com/decimaltenths/" target="_blank" rel="noopener noreferrer">Instagram</a></li>
						<li class="menu-item"><a href="#" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<footer-summary>
			<p>Decimal Tenths offers performance parts, tuning services, laser alignment, all under one roof. Great prices on Tarox, Cobra, Powerflex, Forge Motorsport and so much more. Why not call past Blaydon on Tyne and see the Furious Frog in in real life, or feel free to browse online our wide range of parts and accessories available to collect from HQ or delivered to the North East, Newcastle upon Tyne, Gateshead, Durham, Northumberland, Teesside, Tyne and Wear and the rest of the UK.</p>

			<p class="copyright">&copy; Copyright <?php print date("Y"); ?> Decimal Tenths. Company No. 12818455. All Rights Reserved</p>
			<p class="credit"><a href="https://blueocto.co.uk" target="_blank" rel="noopener noreferrer"><span class="visuallyhidden">WordPress WooCommerce Website by </span>Blueocto Ltd</a></p>
		</footer-summary>
	</footer>

</div><!-- // bo-content -->

<!-- wp_footer -->
<?php wp_footer(); ?>

</body>
</html>