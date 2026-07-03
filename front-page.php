<?php
/**
 * Front page.
 *
 * @package OceanBookingTheme
 */

get_header();
$events = new WP_Query( obt_event_query_args( 6 ) );
$hero_image = get_theme_mod( 'obt_hero_image' );
$hero_style = $hero_image ? ' style="background-image: linear-gradient(120deg, rgba(8,63,108,.92), rgba(7,90,154,.74)), url(' . esc_url( $hero_image ) . ');"' : '';
?>
<section class="hero"<?php echo $hero_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container hero-grid">
		<div>
			<p class="eyebrow"><?php echo esc_html( obt_theme_text( 'hero_eyebrow', __( 'Ocean tickets and guided experiences', 'ocean-booking' ) ) ); ?></p>
			<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
			<p><?php echo esc_html( obt_theme_text( 'hero_body', __( 'Discover bookable coastal experiences with transparent details, real availability, and a smooth checkout handoff.', 'ocean-booking' ) ) ); ?></p>
			<div class="hero-actions">
				<a class="button button-primary" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Browse tickets', 'ocean-booking' ); ?></a>
				<a class="button button-secondary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact us', 'ocean-booking' ); ?></a>
			</div>
		</div>
		<div class="hero-panel">
			<span><?php esc_html_e( 'Live booking ready', 'ocean-booking' ); ?></span>
			<strong><?php esc_html_e( 'Fast, multilingual, mobile-first', 'ocean-booking' ); ?></strong>
		</div>
	</div>
</section>
<section class="section">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Featured events', 'ocean-booking' ); ?></p>
		<h2><?php esc_html_e( 'Popular tickets', 'ocean-booking' ); ?></h2>
	</div>
	<div class="container card-grid">
		<?php
		if ( $events->have_posts() ) :
			while ( $events->have_posts() ) :
				$events->the_post();
				get_template_part( 'template-parts/event-card' );
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<p><?php esc_html_e( 'Add events in WordPress admin to feature them here.', 'ocean-booking' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<section class="section muted">
	<div class="container feature-grid">
		<div><h2><?php echo esc_html( obt_theme_text( 'why_title', __( 'Why book with us', 'ocean-booking' ) ) ); ?></h2><p><?php echo esc_html( obt_theme_text( 'why_body', __( 'Clear meeting points, real provider checkout, translated pages, and fast support before your trip.', 'ocean-booking' ) ) ); ?></p></div>
		<div><h3><?php echo esc_html( obt_theme_text( 'secure_title', __( 'Secure checkout', 'ocean-booking' ) ) ); ?></h3><p><?php echo esc_html( obt_theme_text( 'secure_body', __( 'Payments stay with your existing ticketing provider.', 'ocean-booking' ) ) ); ?></p></div>
		<div><h3><?php echo esc_html( obt_theme_text( 'guidance_title', __( 'Local guidance', 'ocean-booking' ) ) ); ?></h3><p><?php echo esc_html( obt_theme_text( 'guidance_body', __( 'Guides and event content are editable for each language.', 'ocean-booking' ) ) ); ?></p></div>
	</div>
</section>
<section class="section">
	<div class="container split">
		<div>
			<h2><?php echo esc_html( obt_theme_text( 'contact_cta_title', __( 'Questions before booking?', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'contact_cta_body', __( 'Use the contact form, WhatsApp link, or FAQ pages managed in WordPress.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<a class="button button-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Get support', 'ocean-booking' ); ?></a>
	</div>
</section>
<?php
get_footer();
