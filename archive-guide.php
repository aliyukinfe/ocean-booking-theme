<?php
/**
 * Guide archive.
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php post_type_archive_title(); ?></h1>
	</div>
</section>
<section class="section">
	<div class="container card-grid">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article class="event-card">
					<a class="event-card-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'event-card', array( 'loading' => 'lazy' ) ); ?></a>
					<div class="event-card-body">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</article>
				<?php
			endwhile;
		endif;
		?>
	</div>
</section>
<?php
get_footer();

