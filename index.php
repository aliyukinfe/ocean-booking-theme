<?php
/**
 * Fallback template.
 *
 * @package OceanBookingTheme
 */

get_header();
?>
<section class="page-hero compact">
	<div class="container">
		<?php obt_breadcrumbs(); ?>
		<h1><?php echo esc_html( wp_get_document_title() ); ?></h1>
	</div>
</section>
<section class="section">
	<div class="container narrow content-body">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php
					if ( is_singular() ) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</article>
				<?php
			endwhile;
			the_posts_pagination();
		else :
			?>
			<p><?php esc_html_e( 'No content found.', 'ocean-booking' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();

