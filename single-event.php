<?php
/**
 * Single event.
 *
 * @package OceanBookingTheme
 */

get_header();
the_post();
$post_id = get_the_ID();
?>
<article <?php post_class(); ?>>
	<section class="event-hero">
		<div class="container event-hero-grid">
			<div>
				<?php obt_breadcrumbs(); ?>
				<h1><?php the_title(); ?></h1>
				<p><?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'short_description', get_the_excerpt() ) : get_the_excerpt() ); ?></p>
				<div class="facts">
					<span><?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'duration' ) : '' ); ?></span>
					<span><?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'location' ) : '' ); ?></span>
					<span><?php esc_html_e( 'From', 'ocean-booking' ); ?> <?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'price_from' ) : '' ); ?></span>
				</div>
			</div>
			<div class="event-media"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?></div>
		</div>
	</section>
	<section class="section">
		<div class="container content-sidebar">
			<div class="event-content">
				<?php the_content(); ?>
				<?php get_template_part( 'template-parts/event-sections', null, array( 'post_id' => $post_id ) ); ?>
			</div>
			<aside class="booking-card" id="booking-card">
				<h2><?php esc_html_e( 'Book this event', 'ocean-booking' ); ?></h2>
				<?php echo function_exists( 'obc_render_booking_widget' ) ? wp_kses_post( obc_render_booking_widget( $post_id ) ) : ''; ?>
			</aside>
		</div>
	</section>
	<a class="sticky-book" href="#booking-card"><?php esc_html_e( 'Book now', 'ocean-booking' ); ?></a>
</article>
<?php
get_footer();
