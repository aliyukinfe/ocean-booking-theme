<?php
/**
 * Event detail sections.
 *
 * @package OceanBookingTheme
 */

$post_id   = absint( $args['post_id'] ?? get_the_ID() );
$sections  = array(
	'meeting_point'       => __( 'Meeting point', 'ocean-booking' ),
	'check_in_time'       => __( 'Check-in time', 'ocean-booking' ),
	'start_time'          => __( 'Start time', 'ocean-booking' ),
	'return_time'         => __( 'Return time', 'ocean-booking' ),
	'included_features'   => __( 'Included', 'ocean-booking' ),
	'itinerary_timeline'  => __( 'Itinerary', 'ocean-booking' ),
	'good_to_know'        => __( 'Good to know', 'ocean-booking' ),
	'cancellation_policy' => __( 'Cancellation policy', 'ocean-booking' ),
	'faq'                 => __( 'FAQ', 'ocean-booking' ),
);

foreach ( $sections as $key => $label ) :
	$value = function_exists( 'obc_get_event_meta' ) ? obc_get_event_meta( $post_id, $key ) : '';
	if ( ! $value ) {
		continue;
	}
	?>
	<section class="detail-section">
		<h2><?php echo esc_html( $label ); ?></h2>
		<?php if ( in_array( $key, array( 'included_features', 'itinerary_timeline', 'good_to_know', 'faq' ), true ) && function_exists( 'obc_lines_to_list' ) ) : ?>
			<ul>
				<?php foreach ( obc_lines_to_list( $value ) as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><?php echo esc_html( $value ); ?></p>
		<?php endif; ?>
	</section>
<?php endforeach; ?>

