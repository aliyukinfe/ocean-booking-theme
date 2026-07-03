<?php
/**
 * Footer template.
 *
 * @package OceanBookingTheme
 */

?>
</main>
<footer class="site-footer">
	<div class="container footer-grid">
		<div>
			<strong><?php bloginfo( 'name' ); ?></strong>
			<p><?php esc_html_e( 'Premium travel and ocean event booking, managed fully inside WordPress.', 'ocean-booking' ); ?></p>
		</div>
		<nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
	<div class="container footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
		<span><?php esc_html_e( 'Built for multilingual booking operations.', 'ocean-booking' ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

