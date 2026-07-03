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
		<div class="footer-brand">
			<strong><?php bloginfo( 'name' ); ?></strong>
			<p><?php esc_html_e( 'Premium ticket and experience booking, fully managed in WordPress and ready for multilingual guests.', 'ocean-booking' ); ?></p>
			<div class="social-links" aria-label="<?php esc_attr_e( 'Social links', 'ocean-booking' ); ?>">
				<a href="#" aria-label="<?php esc_attr_e( 'Instagram', 'ocean-booking' ); ?>">IG</a>
				<a href="#" aria-label="<?php esc_attr_e( 'Facebook', 'ocean-booking' ); ?>">FB</a>
				<a href="#" aria-label="<?php esc_attr_e( 'YouTube', 'ocean-booking' ); ?>">YT</a>
			</div>
		</div>
		<nav class="footer-links" aria-label="<?php esc_attr_e( 'Footer navigation', 'ocean-booking' ); ?>">
			<h2><?php esc_html_e( 'Explore', 'ocean-booking' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => 'obt_menu_fallback',
				)
			);
			?>
		</nav>
		<nav class="footer-links" aria-label="<?php esc_attr_e( 'Legal links', 'ocean-booking' ); ?>">
			<h2><?php esc_html_e( 'Company', 'ocean-booking' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Tickets', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( get_post_type_archive_link( 'guide' ) ); ?>"><?php esc_html_e( 'Guides', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'ocean-booking' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/imprint/' ) ); ?>"><?php esc_html_e( 'Imprint', 'ocean-booking' ); ?></a></li>
			</ul>
		</nav>
		<div class="footer-newsletter">
			<h2><?php esc_html_e( 'Ticket updates', 'ocean-booking' ); ?></h2>
			<p><?php esc_html_e( 'Add your newsletter provider or form shortcode here when ready.', 'ocean-booking' ); ?></p>
			<form class="newsletter-form" action="#" method="post">
				<label class="screen-reader-text" for="footer-newsletter-email"><?php esc_html_e( 'Email address', 'ocean-booking' ); ?></label>
				<input id="footer-newsletter-email" type="email" placeholder="<?php esc_attr_e( 'Email address', 'ocean-booking' ); ?>">
				<button class="button button-light" type="submit"><?php esc_html_e( 'Join', 'ocean-booking' ); ?></button>
			</form>
		</div>
	</div>
	<div class="container footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
		<span><?php esc_html_e( 'Built for multilingual booking operations.', 'ocean-booking' ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
