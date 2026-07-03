<?php
/**
 * Single guide.
 *
 * @package OceanBookingTheme
 */

get_header();
the_post();
$related = (array) get_post_meta( get_the_ID(), '_obc_related_events', true );
?>
<article <?php post_class(); ?>>
	<section class="page-hero compact">
		<div class="container">
			<?php obt_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="section">
		<div class="container narrow content-body">
			<?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
			<?php the_content(); ?>
		</div>
	</section>
	<?php if ( $related ) : ?>
	<section class="section muted">
		<div class="container section-heading"><h2><?php esc_html_e( 'Related events', 'ocean-booking' ); ?></h2></div>
		<div class="container card-grid">
			<?php
			$events = new WP_Query(
				array(
					'post_type'      => 'event',
					'post__in'       => array_map( 'absint', $related ),
					'posts_per_page' => 3,
				)
			);
			while ( $events->have_posts() ) :
				$events->the_post();
				get_template_part( 'template-parts/event-card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php endif; ?>
</article>
<?php
get_footer();

