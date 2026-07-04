<?php
/**
 * Header template.
 *
 * @package OceanBookingTheme
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'ocean-booking' ); ?></a>
<div class="top-info-bar">
	<div class="container top-info-inner">
		<div class="top-info-items">
			<span><?php esc_html_e( '24/7 Support', 'ocean-booking' ); ?></span>
			<span><?php esc_html_e( 'Secure Payments', 'ocean-booking' ); ?></span>
			<span><?php esc_html_e( 'Instant Confirmation', 'ocean-booking' ); ?></span>
			<span><?php esc_html_e( 'Multilingual', 'ocean-booking' ); ?></span>
		</div>
		<div class="top-socials" aria-label="<?php esc_attr_e( 'Social links', 'ocean-booking' ); ?>">
			<a href="#" aria-label="<?php esc_attr_e( 'Instagram', 'ocean-booking' ); ?>">IG</a>
			<a href="#" aria-label="<?php esc_attr_e( 'Facebook', 'ocean-booking' ); ?>">FB</a>
			<a href="#" aria-label="<?php esc_attr_e( 'YouTube', 'ocean-booking' ); ?>">YT</a>
			<div class="top-language-switcher" aria-label="<?php esc_attr_e( 'Language switcher', 'ocean-booking' ); ?>">
				<?php obt_language_switcher(); ?>
			</div>
		</div>
	</div>
</div>
<header class="site-header is-transparent">
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>
		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-menu"><span></span><span></span><span></span><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'ocean-booking' ); ?></span></button>
		<nav class="primary-nav" id="primary-menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'obt_menu_fallback',
				)
			);
			?>
		</nav>
		<div class="language-switcher" aria-label="<?php esc_attr_e( 'Language switcher', 'ocean-booking' ); ?>">
			<?php obt_language_switcher(); ?>
		</div>
		<a class="header-cta" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Book Now', 'ocean-booking' ); ?></a>
	</div>
</header>
<main id="content" class="site-main">
