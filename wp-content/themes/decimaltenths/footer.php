<footer class="footer" role="contentinfo">

<div class="row">
	<div class="column small-12 medium-6 xlarge-3">
		<p class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
				<span class="visuallyhidden"><?php bloginfo( 'name' ); ?></span>
				<img src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/logo-black.svg'; ?>" alt="Decimal Tenths logo" loading="lazy" width="300" height="83" />
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
	<?php 
	if( have_rows('footer_socials', 'option') ):
		?>
		<div class="column small-12 medium-6 xlarge-3">
			<h3 class="h4">Social</h3>
			<nav>
				<ul class="menu footer--menu">
		<?php
		while ( have_rows( 'footer_socials', 'option' ) ) : the_row();
		?>
			<li class="menu-item"><a href="<?php print(get_sub_field("link_url", 'option')); ?>" target="_blank" rel="noopener noreferrer"><?php print(get_sub_field("link_text", 'option')); ?></a></li>
		<?php
		endwhile;
		?>
				</ul>
			</nav>
		</div>
	<?php
	endif;
	?>
</div>
<footer-summary>
	<?php print(get_field("footer_summary", 'option')); ?>

	<p class="copyright">&copy; Copyright <?php print date("Y"); ?> <?php print(get_field("footer_copyright", 'option')); ?></p>
	<p class="credit"><a href="https://blueocto.co.uk" target="_blank" rel="noopener noreferrer"><span class="visuallyhidden">WordPress WooCommerce Website by </span>Blueocto Ltd</a></p>
</footer-summary>
</footer>

</div><!-- // bo-content -->

<!-- wp_footer -->
<?php wp_footer(); ?>

</body>
</html>