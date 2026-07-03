<?php
/**
 * Generic page.
 *
 * @package OceanBookingTheme
 */

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<section class="page-hero compact">
		<div class="container">
			<?php obt_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="section">
		<div class="container narrow content-body">
			<?php the_content(); ?>
		</div>
	</section>
	<?php
endwhile;
get_footer();

