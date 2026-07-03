<?php
/**
 * Event archive.
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php post_type_archive_title(); ?></h1>
		<p><?php esc_html_e( 'Filter bookable events by location, category, and sort preference.', 'ocean-booking' ); ?></p>
	</div>
</section>
<section class="section">
	<div class="container">
		<form class="filter-bar" method="get">
			<?php
			wp_dropdown_categories(
				array(
					'taxonomy'        => 'event_location',
					'name'            => 'event_location',
					'show_option_all' => __( 'All locations', 'ocean-booking' ),
					'value_field'     => 'slug',
					'selected'        => sanitize_text_field( wp_unslash( $_GET['event_location'] ?? '' ) ),
				)
			);
			wp_dropdown_categories(
				array(
					'taxonomy'        => 'event_category',
					'name'            => 'event_category',
					'show_option_all' => __( 'All categories', 'ocean-booking' ),
					'value_field'     => 'slug',
					'selected'        => sanitize_text_field( wp_unslash( $_GET['event_category'] ?? '' ) ),
				)
			);
			?>
			<select name="sort">
				<option value="newest"><?php esc_html_e( 'Newest', 'ocean-booking' ); ?></option>
				<option value="price"><?php esc_html_e( 'Price', 'ocean-booking' ); ?></option>
				<option value="popular"><?php esc_html_e( 'Popular', 'ocean-booking' ); ?></option>
			</select>
			<button class="button button-primary" type="submit"><?php esc_html_e( 'Filter', 'ocean-booking' ); ?></button>
		</form>
		<div class="card-grid">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/event-card' );
				endwhile;
			else :
				?>
				<p><?php esc_html_e( 'No events found.', 'ocean-booking' ); ?></p>
			<?php endif; ?>
		</div>
		<?php the_posts_pagination(); ?>
	</div>
</section>
<?php
get_footer();

