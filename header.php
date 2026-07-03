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
<header class="site-header">
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
			<?php
			if ( function_exists( 'pll_the_languages' ) ) {
				pll_the_languages( array( 'dropdown' => 1 ) );
			} else {
				?>
				<span><?php esc_html_e( 'EN', 'ocean-booking' ); ?></span>
				<span><?php esc_html_e( 'DE', 'ocean-booking' ); ?></span>
				<?php
			}
			?>
		</div>
		<a class="header-cta" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Tickets', 'ocean-booking' ); ?></a>
	</div>
</header>
<main id="content" class="site-main">
