<?php
/**
 * Template Name: Booking Confirmation
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php the_title(); ?></h1>
		<p><?php esc_html_e( 'Thank you. Your final confirmation details are provided by the connected booking provider.', 'ocean-booking' ); ?></p>
	</div>
</section>
<section class="section">
	<div class="container narrow content-body">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</section>
<?php
get_footer();

