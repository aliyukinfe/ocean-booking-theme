<?php
/**
 * Template Name: Contact
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php the_title(); ?></h1>
	</div>
</section>
<section class="section">
	<div class="container content-sidebar">
		<div class="content-body">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
		<aside class="booking-card">
			<?php echo do_shortcode( '[ocean_contact_form]' ); ?>
		</aside>
	</div>
</section>
<?php
get_footer();

