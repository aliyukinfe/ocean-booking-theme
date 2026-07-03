<?php
/**
 * Event card.
 *
 * @package OceanBookingTheme
 */

$post_id = get_the_ID();
$location = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'location' ) : '';
$date = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'event_date' ) : '';
$time = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'start_time' ) : '';
$duration = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'duration' ) : '';
$price = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'price_from' ) : '';
$meeting = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'meeting_point' ) : '';
$rating = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'event_rating', '5.0' ) : '5.0';
$availability = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, 'availability', __( 'Available', 'ocean-booking' ) ) : __( 'Available', 'ocean-booking' );
$categories = get_the_terms( $post_id, 'event_category' );
$category = ( ! is_wp_error( $categories ) && ! empty( $categories ) ) ? $categories[0]->name : __( 'Experience', 'ocean-booking' );
?>
<article class="event-card">
	<a class="event-card-image" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'event-card', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span><?php esc_html_e( 'Ticket', 'ocean-booking' ); ?></span>
		<?php endif; ?>
		<em><?php echo esc_html( $category ); ?></em>
	</a>
	<div class="event-card-body">
		<p class="eyebrow"><?php echo esc_html( $location ? $location : __( 'Featured experience', 'ocean-booking' ) ); ?></p>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php the_excerpt(); ?></p>
		<div class="ticket-meta">
			<span><?php echo esc_html( $date ? $date : __( 'Flexible dates', 'ocean-booking' ) ); ?><?php echo $time ? ' &middot; ' . esc_html( $time ) : ''; ?></span>
			<span><?php echo esc_html( $duration ? $duration : __( 'Duration set by admin', 'ocean-booking' ) ); ?></span>
			<span><?php echo esc_html( $meeting ? $meeting : __( 'Meeting point managed in admin', 'ocean-booking' ) ); ?></span>
		</div>
		<div class="ticket-status">
			<span><?php echo esc_html( $rating ); ?> <?php esc_html_e( '/ 5 rating', 'ocean-booking' ); ?></span>
			<span><?php echo esc_html( $availability ); ?></span>
		</div>
		<div class="card-footer">
			<strong><?php esc_html_e( 'From', 'ocean-booking' ); ?> <?php echo esc_html( $price ? $price : __( 'TBA', 'ocean-booking' ) ); ?></strong>
			<div class="card-actions">
				<a class="button button-secondary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'ocean-booking' ); ?></a>
				<a class="button button-primary" href="<?php echo esc_url( get_permalink() . '#booking-card' ); ?>"><?php esc_html_e( 'Book now', 'ocean-booking' ); ?></a>
			</div>
		</div>
	</div>
</article>
