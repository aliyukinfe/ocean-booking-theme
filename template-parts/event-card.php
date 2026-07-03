<?php
/**
 * Event card.
 *
 * @package OceanBookingTheme
 */

$post_id = get_the_ID();
?>
<article class="event-card">
	<a class="event-card-image" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'event-card', array( 'loading' => 'lazy' ) ); ?>
		<?php endif; ?>
	</a>
	<div class="event-card-body">
		<p class="eyebrow"><?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'location' ) : '' ); ?></p>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php the_excerpt(); ?></p>
		<div class="card-footer">
			<span><?php esc_html_e( 'From', 'ocean-booking' ); ?> <?php echo esc_html( function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'price_from' ) : '' ); ?></span>
			<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'ocean-booking' ); ?></a>
		</div>
	</div>
</article>

