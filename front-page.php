<?php
/**
 * Premium front page.
 *
 * @package OceanBookingTheme
 */

get_header();

$featured_events = new WP_Query( obt_event_query_args( 4 ) );
$popular_events  = new WP_Query(
	array_merge(
		obt_event_query_args( 4 ),
		array(
			'orderby' => 'comment_count',
			'order'   => 'DESC',
		)
	)
);

$images = array(
	'hero'          => obt_theme_image( 'hero_image', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1800&q=80' ),
	'destination_1' => obt_theme_image( 'destination_1_img', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80' ),
	'destination_2' => obt_theme_image( 'destination_2_img', 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80' ),
	'destination_3' => obt_theme_image( 'destination_3_img', 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=900&q=80' ),
	'gallery_1'     => obt_theme_image( 'gallery_1_img', 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80' ),
	'gallery_2'     => obt_theme_image( 'gallery_2_img', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80' ),
	'gallery_3'     => obt_theme_image( 'gallery_3_img', 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=900&q=80' ),
	'gallery_4'     => obt_theme_image( 'gallery_4_img', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80' ),
	'contact'       => obt_theme_image( 'contact_bg_img', 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1600&q=80' ),
);

$hero_style    = ' style="background-image: linear-gradient(90deg, rgba(4,21,38,.84), rgba(4,42,72,.58)), url(' . esc_url( $images['hero'] ) . ');"';
$contact_style = ' style="background-image: linear-gradient(90deg, rgba(4,21,38,.86), rgba(8,63,108,.62)), url(' . esc_url( $images['contact'] ) . ');"';

$trust_items = array(
	array( __( 'Fast Booking', 'ocean-booking' ), __( 'Reserve in minutes', 'ocean-booking' ) ),
	array( __( 'Secure Checkout', 'ocean-booking' ), __( 'Provider payment flow', 'ocean-booking' ) ),
	array( __( 'Instant Confirmation', 'ocean-booking' ), __( 'Clear next steps', 'ocean-booking' ) ),
	array( __( 'Mobile Tickets', 'ocean-booking' ), __( 'Built for phones', 'ocean-booking' ) ),
	array( __( '5 Languages', 'ocean-booking' ), __( 'Ready for translation', 'ocean-booking' ) ),
);

$destinations = array(
	array( obt_theme_text( 'destination_1_title', __( 'Island Escapes', 'ocean-booking' ) ), obt_theme_text( 'destination_1_count', __( '12 experiences', 'ocean-booking' ) ), $images['destination_1'] ),
	array( obt_theme_text( 'destination_2_title', __( 'Coastal Tours', 'ocean-booking' ) ), obt_theme_text( 'destination_2_count', __( '18 experiences', 'ocean-booking' ) ), $images['destination_2'] ),
	array( obt_theme_text( 'destination_3_title', __( 'Harbor Nights', 'ocean-booking' ) ), obt_theme_text( 'destination_3_count', __( '9 experiences', 'ocean-booking' ) ), $images['destination_3'] ),
);

$why_items = array(
	array( __( 'Best Price Guarantee', 'ocean-booking' ), __( 'Show clear price-from details and route guests to your trusted checkout.', 'ocean-booking' ) ),
	array( __( 'Fast Booking', 'ocean-booking' ), __( 'A focused path from ticket discovery to provider confirmation.', 'ocean-booking' ) ),
	array( __( 'Local Experts', 'ocean-booking' ), __( 'Add meeting points, good-to-know notes, guides, and trip policies.', 'ocean-booking' ) ),
	array( __( 'Free Cancellation', 'ocean-booking' ), __( 'Display each event cancellation policy before guests commit.', 'ocean-booking' ) ),
	array( __( 'Secure Payments', 'ocean-booking' ), __( 'Payments remain with the real booking platform, not a fake flow.', 'ocean-booking' ) ),
	array( __( 'Instant Tickets', 'ocean-booking' ), __( 'Use embedded, API, or external checkout modes for real confirmations.', 'ocean-booking' ) ),
);

$reviews = array(
	array( obt_theme_text( 'review_1_text', __( 'The site makes it simple to compare experiences, check details, and book on mobile without confusion.', 'ocean-booking' ) ), obt_theme_text( 'review_1_name', __( 'Maya R.', 'ocean-booking' ) ), obt_theme_text( 'review_1_country', __( 'Germany', 'ocean-booking' ) ) ),
	array( obt_theme_text( 'review_2_text', __( 'Beautiful presentation, clear meeting information, and a checkout path that feels trustworthy.', 'ocean-booking' ) ), obt_theme_text( 'review_2_name', __( 'Luca P.', 'ocean-booking' ) ), obt_theme_text( 'review_2_country', __( 'Italy', 'ocean-booking' ) ) ),
	array( obt_theme_text( 'review_3_text', __( 'Exactly the kind of polished ticket experience guests expect from a premium travel brand.', 'ocean-booking' ) ), obt_theme_text( 'review_3_name', __( 'Sofia M.', 'ocean-booking' ) ), obt_theme_text( 'review_3_country', __( 'Spain', 'ocean-booking' ) ) ),
);

$steps = array(
	array( __( 'Choose Experience', 'ocean-booking' ), __( 'Browse destinations, popular tickets, and curated event cards.', 'ocean-booking' ) ),
	array( __( 'Select Tickets', 'ocean-booking' ), __( 'Review duration, meeting point, availability, rating, and price.', 'ocean-booking' ) ),
	array( __( 'Enjoy Your Trip', 'ocean-booking' ), __( 'Continue to the connected booking provider and get ready to travel.', 'ocean-booking' ) ),
);

$faqs = array(
	array( obt_theme_text( 'faq_1_question', __( 'Can I replace the images?', 'ocean-booking' ) ), obt_theme_text( 'faq_1_answer', __( 'Yes. The hero, destination, gallery, and contact images are editable in the WordPress Customizer.', 'ocean-booking' ) ) ),
	array( obt_theme_text( 'faq_2_question', __( 'Where do tickets come from?', 'ocean-booking' ) ), obt_theme_text( 'faq_2_answer', __( 'Tickets are managed as Events in WordPress and can connect to your real booking provider.', 'ocean-booking' ) ) ),
	array( obt_theme_text( 'faq_3_question', __( 'Does this support multiple languages?', 'ocean-booking' ) ), obt_theme_text( 'faq_3_answer', __( 'Yes. All theme strings are translation-ready and the structure works with Polylang, WPML, or TranslatePress.', 'ocean-booking' ) ) ),
);

$gallery = array(
	array( $images['gallery_1'], obt_theme_text( 'gallery_1_label', __( 'Ocean tours', 'ocean-booking' ) ) ),
	array( $images['gallery_2'], obt_theme_text( 'gallery_2_label', __( 'Beach clubs', 'ocean-booking' ) ) ),
	array( $images['gallery_3'], obt_theme_text( 'gallery_3_label', __( 'Boat activities', 'ocean-booking' ) ) ),
	array( $images['gallery_4'], obt_theme_text( 'gallery_4_label', __( 'Travel moments', 'ocean-booking' ) ) ),
);
?>
<!-- ocean-booking-homepage:premium-v4 -->
<section class="hero hero-premium hero-fullscreen"<?php echo $hero_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="hero-orbit hero-orbit-one" aria-hidden="true"></div>
	<div class="hero-orbit hero-orbit-two" aria-hidden="true"></div>
	<div class="container hero-grid">
		<div class="hero-copy">
			<p class="eyebrow hero-eyebrow"><?php echo esc_html( obt_theme_text( 'hero_eyebrow', __( 'Premium travel tickets and guided experiences', 'ocean-booking' ) ) ); ?></p>
			<h1><?php echo esc_html( obt_theme_text( 'hero_title', __( 'Book unforgettable travel experiences', 'ocean-booking' ) ) ); ?></h1>
			<p><?php echo esc_html( obt_theme_text( 'hero_body', __( 'Discover premium tickets, compare travel details, and continue to secure provider checkout from any device.', 'ocean-booking' ) ) ); ?></p>
			<div class="hero-actions">
				<a class="button button-primary button-large" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Book Tickets', 'ocean-booking' ); ?></a>
				<a class="button button-ghost button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'ocean-booking' ); ?></a>
			</div>
		</div>
		<div class="hero-floating">
			<div class="review-float glass-card">
				<span class="rating-text"><?php esc_html_e( '5.0 / 5 guest rating', 'ocean-booking' ); ?></span>
				<p><?php echo esc_html( obt_theme_text( 'hero_review', __( 'A seamless way to discover, compare, and book memorable travel experiences.', 'ocean-booking' ) ) ); ?></p>
				<strong><?php echo esc_html( obt_theme_text( 'hero_review_name', __( 'Verified traveler', 'ocean-booking' ) ) ); ?></strong>
			</div>
			<div class="stats-float">
				<div><strong><?php esc_html_e( '24/7', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Support', 'ocean-booking' ); ?></span></div>
				<div><strong><?php esc_html_e( '5', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Languages', 'ocean-booking' ); ?></span></div>
				<div><strong><?php esc_html_e( '90+', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Speed target', 'ocean-booking' ); ?></span></div>
			</div>
		</div>
	</div>
</section>

<section class="trust-overlap">
	<div class="container trust-grid">
		<?php foreach ( $trust_items as $item ) : ?>
			<article class="trust-card">
				<span aria-hidden="true"></span>
				<h3><?php echo esc_html( $item[0] ); ?></h3>
				<p><?php echo esc_html( $item[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section">
	<div class="container section-heading split-heading">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Featured experiences', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'featured_title', __( 'Premium tickets ready to sell', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'featured_body', __( 'Show your best experiences with polished cards, rich details, and direct booking calls to action.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<a class="button button-secondary" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'View all tickets', 'ocean-booking' ); ?></a>
	</div>
	<div class="container premium-card-grid">
		<?php if ( $featured_events->have_posts() ) : ?>
			<?php
			while ( $featured_events->have_posts() ) :
				$featured_events->the_post();
				get_template_part( 'template-parts/event-card' );
			endwhile;
			wp_reset_postdata();
			?>
		<?php else : ?>
			<div class="empty-state full-span">
				<span class="empty-icon" aria-hidden="true"></span>
				<h3><?php esc_html_e( 'Add your first event in WordPress admin to display tickets here.', 'ocean-booking' ); ?></h3>
				<p><?php esc_html_e( 'Publish Events with images, price, duration, meeting point, rating, and availability to replace this setup state automatically.', 'ocean-booking' ); ?></p>
				<a class="button button-primary" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=event' ) ); ?>"><?php esc_html_e( 'Add first event', 'ocean-booking' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="section muted destinations-section">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Popular destinations', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'destinations_title', __( 'Explore places guests love', 'ocean-booking' ) ) ); ?></h2>
		<p><?php echo esc_html( obt_theme_text( 'destinations_body', __( 'Use destination blocks to promote regions, harbors, islands, beach clubs, tours, and seasonal hotspots.', 'ocean-booking' ) ) ); ?></p>
	</div>
	<div class="container destination-rail">
		<?php foreach ( $destinations as $destination ) : ?>
			<article class="destination-card image-card" style="background-image: linear-gradient(180deg, rgba(6,28,50,.05), rgba(6,28,50,.78)), url('<?php echo esc_url( $destination[2] ); ?>');">
				<div>
					<p><?php echo esc_html( $destination[1] ); ?></p>
					<h3><?php echo esc_html( $destination[0] ); ?></h3>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Explore', 'ocean-booking' ); ?></a>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Why choose us', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'why_title', __( 'Everything guests need before they book', 'ocean-booking' ) ) ); ?></h2>
		<p><?php echo esc_html( obt_theme_text( 'why_body', __( 'A premium booking homepage should reduce doubt, answer questions, and route visitors to the real checkout quickly.', 'ocean-booking' ) ) ); ?></p>
	</div>
	<div class="container benefit-grid">
		<?php foreach ( $why_items as $item ) : ?>
			<article class="benefit-card icon-card">
				<span aria-hidden="true"></span>
				<h3><?php echo esc_html( $item[0] ); ?></h3>
				<p><?php echo esc_html( $item[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section muted">
	<div class="container slider-heading">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'Customer reviews', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'reviews_title', __( 'Travelers book with confidence', 'ocean-booking' ) ) ); ?></h2>
		</div>
		<div class="slider-controls">
			<button type="button" data-slider-button="#reviews-slider" data-direction="prev" aria-label="<?php esc_attr_e( 'Previous review', 'ocean-booking' ); ?>"></button>
			<button type="button" data-slider-button="#reviews-slider" data-direction="next" aria-label="<?php esc_attr_e( 'Next review', 'ocean-booking' ); ?>"></button>
		</div>
	</div>
	<div class="container review-slider" id="reviews-slider">
		<?php foreach ( $reviews as $review ) : ?>
			<figure class="review-card slider-card">
				<div class="avatar" aria-hidden="true"></div>
				<span class="rating-text"><?php esc_html_e( '5.0 / 5', 'ocean-booking' ); ?></span>
				<blockquote><?php echo esc_html( $review[0] ); ?></blockquote>
				<figcaption><strong><?php echo esc_html( $review[1] ); ?></strong><span><?php echo esc_html( $review[2] ); ?></span></figcaption>
			</figure>
		<?php endforeach; ?>
	</div>
</section>

<section class="section gallery-section">
	<div class="container section-heading split-heading">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Photo gallery', 'ocean-booking' ); ?></p>
			<h2><?php esc_html_e( 'A visual preview of the trip experience', 'ocean-booking' ); ?></h2>
			<p><?php esc_html_e( 'Replace these royalty-free placeholders with your own media library images when the brand photography is ready.', 'ocean-booking' ); ?></p>
		</div>
		<a class="button button-secondary" href="<?php echo esc_url( get_post_type_archive_link( 'guide' ) ); ?>"><?php esc_html_e( 'Travel guides', 'ocean-booking' ); ?></a>
	</div>
	<div class="container masonry-gallery">
		<?php foreach ( $gallery as $index => $image ) : ?>
			<a class="gallery-item gallery-item-<?php echo esc_attr( (string) ( $index + 1 ) ); ?>" href="<?php echo esc_url( $image[0] ); ?>">
				<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image[1] ); ?>" loading="lazy">
				<span><?php echo esc_html( $image[1] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<section class="section">
	<div class="container process-panel premium-process">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'How it works', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'how_title', __( 'Book in three simple steps', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'how_body', __( 'A clean booking flow helps guests move from inspiration to confirmation without friction.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<div class="steps-grid">
			<?php foreach ( $steps as $index => $step ) : ?>
				<article class="step-card illustrated-card">
					<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container faq-newsletter-grid">
		<div>
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'FAQ', 'ocean-booking' ); ?></p>
				<h2><?php echo esc_html( obt_theme_text( 'faq_title', __( 'Booking questions answered', 'ocean-booking' ) ) ); ?></h2>
			</div>
			<div class="faq-list">
				<?php foreach ( $faqs as $faq ) : ?>
					<details>
						<summary><?php echo esc_html( $faq[0] ); ?></summary>
						<p><?php echo esc_html( $faq[1] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
		<aside class="newsletter-card luxe-newsletter">
			<p class="eyebrow"><?php esc_html_e( 'Newsletter', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'newsletter_title', __( 'Get travel inspiration and ticket updates', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'newsletter_body', __( 'Invite visitors to subscribe for new departures, destination ideas, and seasonal offers.', 'ocean-booking' ) ) ); ?></p>
			<form class="newsletter-form" action="#" method="post">
				<label class="screen-reader-text" for="newsletter-email"><?php esc_html_e( 'Email address', 'ocean-booking' ); ?></label>
				<input id="newsletter-email" type="email" placeholder="<?php esc_attr_e( 'Email address', 'ocean-booking' ); ?>">
				<button class="button button-primary" type="submit"><?php esc_html_e( 'Subscribe', 'ocean-booking' ); ?></button>
			</form>
		</aside>
	</div>
</section>

<section class="contact-image-cta"<?php echo $contact_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container contact-cta-inner">
		<p class="eyebrow hero-eyebrow"><?php esc_html_e( 'Support', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'contact_cta_title', __( 'Need help planning the perfect booking?', 'ocean-booking' ) ) ); ?></h2>
		<p><?php echo esc_html( obt_theme_text( 'contact_cta_body', __( 'Offer fast support through WhatsApp, email, phone, or your preferred customer service channel.', 'ocean-booking' ) ) ); ?></p>
		<div class="hero-actions">
			<a class="button button-primary button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'WhatsApp', 'ocean-booking' ); ?></a>
			<a class="button button-ghost button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Email us', 'ocean-booking' ); ?></a>
			<a class="button button-ghost button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Call support', 'ocean-booking' ); ?></a>
		</div>
	</div>
</section>
<?php
get_footer();
