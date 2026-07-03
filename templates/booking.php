<?php
/**
 * Template Name: Booking
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php the_title(); ?></h1>
		<p><?php esc_html_e( 'Select an event to continue to the live booking system.', 'ocean-booking' ); ?></p>
	</div>
</section>
<section class="section">
	<div class="container card-grid">
		<?php
		$events = new WP_Query( obt_event_query_args( 9 ) );
		while ( $events->have_posts() ) :
			$events->the_post();
			get_template_part( 'template-parts/event-card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
<?php
get_footer();

