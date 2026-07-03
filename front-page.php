<?php
/**
 * Front page.
 *
 * @package OceanBookingTheme
 */

get_header();

$featured_events = new WP_Query( obt_event_query_args( 3 ) );
$upcoming_events = new WP_Query(
	array_merge(
		obt_event_query_args( 3 ),
		array(
			'meta_key' => '_obc_event_date',
			'orderby'  => 'meta_value',
			'order'    => 'ASC',
		)
	)
);
$popular_events = new WP_Query(
	array_merge(
		obt_event_query_args( 3 ),
		array(
			'orderby' => 'comment_count',
			'order'   => 'DESC',
		)
	)
);

$hero_image = get_theme_mod( 'obt_hero_image' );
$hero_style = $hero_image ? ' style="background-image: linear-gradient(120deg, rgba(6,34,62,.88), rgba(7,90,154,.76)), url(' . esc_url( $hero_image ) . ');"' : '';

$trust_items = array(
	__( 'Fast booking', 'ocean-booking' ),
	__( 'Secure checkout', 'ocean-booking' ),
	__( 'Mobile-first tickets', 'ocean-booking' ),
	__( 'Multilingual support', 'ocean-booking' ),
);

$why_items = array(
	array( __( 'Secure checkout', 'ocean-booking' ), __( 'Send guests to your existing trusted booking and payment provider.', 'ocean-booking' ) ),
	array( __( 'Local guidance', 'ocean-booking' ), __( 'Add meeting points, trip notes, cancellation terms, and guides for every experience.', 'ocean-booking' ) ),
	array( __( 'Multilingual support', 'ocean-booking' ), __( 'Translate events, legal pages, menus, and booking content for international guests.', 'ocean-booking' ) ),
	array( __( 'Mobile tickets', 'ocean-booking' ), __( 'A responsive ticket path keeps browsing and booking smooth on phones.', 'ocean-booking' ) ),
	array( __( 'Fast confirmation', 'ocean-booking' ), __( 'Use provider checkout redirects or embeds to keep confirmation workflows real.', 'ocean-booking' ) ),
	array( __( 'Trusted providers', 'ocean-booking' ), __( 'Connect the website to the booking system your operation already uses.', 'ocean-booking' ) ),
);

$steps = array(
	array( __( 'Choose your event', 'ocean-booking' ), __( 'Browse tickets by destination, timing, price, or experience type.', 'ocean-booking' ) ),
	array( __( 'Select tickets', 'ocean-booking' ), __( 'Review inclusions, meeting point, availability, and trip details.', 'ocean-booking' ) ),
	array( __( 'Book securely', 'ocean-booking' ), __( 'Continue to the connected checkout or embedded provider widget.', 'ocean-booking' ) ),
);

$destinations = array(
	array( __( 'Harbor departures', 'ocean-booking' ), __( 'Perfect for cruises, transfers, and sunset tickets.', 'ocean-booking' ) ),
	array( __( 'Coastal adventures', 'ocean-booking' ), __( 'Showcase snorkeling, sailing, beach, and island experiences.', 'ocean-booking' ) ),
	array( __( 'City highlights', 'ocean-booking' ), __( 'Group tickets around local attractions and guided routes.', 'ocean-booking' ) ),
);

$reviews = array(
	array( __( 'The booking process was clear from start to finish, especially on mobile.', 'ocean-booking' ), __( 'Verified guest', 'ocean-booking' ) ),
	array( __( 'All meeting details and ticket information were easy to find before checkout.', 'ocean-booking' ), __( 'Tour customer', 'ocean-booking' ) ),
	array( __( 'A polished way to present experiences in multiple languages.', 'ocean-booking' ), __( 'Travel partner', 'ocean-booking' ) ),
);

$faqs = array(
	array( __( 'Can guests pay on this website?', 'ocean-booking' ), __( 'Payments should be handled by your connected booking provider through embed, API, or checkout redirect.', 'ocean-booking' ) ),
	array( __( 'Can content be translated?', 'ocean-booking' ), __( 'Yes. The theme and plugin are translation-ready and compatible with Polylang, WPML, or TranslatePress.', 'ocean-booking' ) ),
	array( __( 'What happens before events are added?', 'ocean-booking' ), __( 'The homepage shows a professional empty state so the site still feels complete during setup.', 'ocean-booking' ) ),
);
?>
<section class="hero hero-premium"<?php echo $hero_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="hero-wave" aria-hidden="true"></div>
	<div class="container hero-grid">
		<div class="hero-copy">
			<p class="eyebrow hero-eyebrow"><?php echo esc_html( obt_theme_text( 'hero_eyebrow', __( 'Ocean tickets and guided experiences', 'ocean-booking' ) ) ); ?></p>
			<h1><?php echo esc_html( obt_theme_text( 'hero_title', __( 'Book unforgettable ocean experiences', 'ocean-booking' ) ) ); ?></h1>
			<p><?php echo esc_html( obt_theme_text( 'hero_body', __( 'Browse premium tickets, compare details, and continue to a secure provider checkout from any device.', 'ocean-booking' ) ) ); ?></p>
			<div class="hero-actions">
				<a class="button button-primary button-large" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'Browse Tickets', 'ocean-booking' ); ?></a>
				<a class="button button-ghost button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'ocean-booking' ); ?></a>
			</div>
			<div class="trust-strip" aria-label="<?php esc_attr_e( 'Booking benefits', 'ocean-booking' ); ?>">
				<?php foreach ( $trust_items as $item ) : ?>
					<span><?php echo esc_html( $item ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="hero-panel premium-panel">
			<p><?php esc_html_e( 'Booking operations dashboard', 'ocean-booking' ); ?></p>
			<div class="stat-grid">
				<div><strong><?php esc_html_e( 'Fast', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Booking', 'ocean-booking' ); ?></span></div>
				<div><strong><?php esc_html_e( 'Safe', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Checkout', 'ocean-booking' ); ?></span></div>
				<div><strong><?php esc_html_e( 'Mobile', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Tickets', 'ocean-booking' ); ?></span></div>
				<div><strong><?php esc_html_e( '5', 'ocean-booking' ); ?></strong><span><?php esc_html_e( 'Languages', 'ocean-booking' ); ?></span></div>
			</div>
			<div class="mini-ticket">
				<span><?php esc_html_e( 'Next departure', 'ocean-booking' ); ?></span>
				<strong><?php esc_html_e( 'Ready when events are added', 'ocean-booking' ); ?></strong>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'View tickets', 'ocean-booking' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="section section-overlap">
	<div class="container section-heading split-heading">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Featured events', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'featured_title', __( 'Featured tickets', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'featured_body', __( 'Highlight your best-selling experiences and seasonal offers from the WordPress event manager.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<a class="button button-secondary" href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"><?php esc_html_e( 'All tickets', 'ocean-booking' ); ?></a>
	</div>
	<div class="container card-grid">
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
				<p><?php esc_html_e( 'Once events are published, this area becomes a polished ticket showcase with images, timing, price, duration, and booking links.', 'ocean-booking' ); ?></p>
				<a class="button button-primary" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=event' ) ); ?>"><?php esc_html_e( 'Add first event', 'ocean-booking' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="section muted">
	<div class="container dual-sections">
		<div>
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Upcoming', 'ocean-booking' ); ?></p>
				<h2><?php echo esc_html( obt_theme_text( 'upcoming_title', __( 'Upcoming departures', 'ocean-booking' ) ) ); ?></h2>
			</div>
			<div class="stack-list">
				<?php if ( $upcoming_events->have_posts() ) : ?>
					<?php
					while ( $upcoming_events->have_posts() ) :
						$upcoming_events->the_post();
						get_template_part( 'template-parts/event-card' );
					endwhile;
					wp_reset_postdata();
					?>
				<?php else : ?>
					<div class="compact-empty"><?php esc_html_e( 'Publish dated events to fill this upcoming tickets list.', 'ocean-booking' ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<div>
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Popular', 'ocean-booking' ); ?></p>
				<h2><?php echo esc_html( obt_theme_text( 'popular_title', __( 'Popular tickets', 'ocean-booking' ) ) ); ?></h2>
			</div>
			<div class="stack-list">
				<?php if ( $popular_events->have_posts() ) : ?>
					<?php
					while ( $popular_events->have_posts() ) :
						$popular_events->the_post();
						get_template_part( 'template-parts/event-card' );
					endwhile;
					wp_reset_postdata();
					?>
				<?php else : ?>
					<div class="compact-empty"><?php esc_html_e( 'Popular tickets appear automatically after events are published.', 'ocean-booking' ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Destinations', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'destinations_title', __( 'Explore destinations', 'ocean-booking' ) ) ); ?></h2>
		<p><?php echo esc_html( obt_theme_text( 'destinations_body', __( 'Organize tickets by locations, harbors, beaches, cities, or regions.', 'ocean-booking' ) ) ); ?></p>
	</div>
	<div class="container destination-grid">
		<?php foreach ( $destinations as $destination ) : ?>
			<article class="destination-card">
				<span aria-hidden="true"></span>
				<h3><?php echo esc_html( $destination[0] ); ?></h3>
				<p><?php echo esc_html( $destination[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section muted">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Confidence', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'why_title', __( 'Why book with us', 'ocean-booking' ) ) ); ?></h2>
		<p><?php echo esc_html( obt_theme_text( 'why_body', __( 'Give guests the details they need before booking, with real checkout integration and translated content.', 'ocean-booking' ) ) ); ?></p>
	</div>
	<div class="container benefit-grid">
		<?php foreach ( $why_items as $item ) : ?>
			<article class="benefit-card">
				<span aria-hidden="true"></span>
				<h3><?php echo esc_html( $item[0] ); ?></h3>
				<p><?php echo esc_html( $item[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section">
	<div class="container process-panel">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'Simple flow', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'how_title', __( 'How booking works', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'how_body', __( 'A simple three-step flow keeps guests confident from discovery to confirmation.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<div class="steps-grid">
			<?php foreach ( $steps as $index => $step ) : ?>
				<article class="step-card">
					<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section muted">
	<div class="container section-heading">
		<p class="eyebrow"><?php esc_html_e( 'Reviews', 'ocean-booking' ); ?></p>
		<h2><?php echo esc_html( obt_theme_text( 'reviews_title', __( 'Guest confidence, built in', 'ocean-booking' ) ) ); ?></h2>
	</div>
	<div class="container review-grid">
		<?php foreach ( $reviews as $review ) : ?>
			<figure class="review-card">
				<blockquote><?php echo esc_html( $review[0] ); ?></blockquote>
				<figcaption><?php echo esc_html( $review[1] ); ?></figcaption>
			</figure>
		<?php endforeach; ?>
	</div>
</section>

<section class="section">
	<div class="container faq-newsletter-grid">
		<div>
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'FAQ', 'ocean-booking' ); ?></p>
				<h2><?php echo esc_html( obt_theme_text( 'faq_title', __( 'Booking questions', 'ocean-booking' ) ) ); ?></h2>
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
		<aside class="newsletter-card">
			<p class="eyebrow"><?php esc_html_e( 'Newsletter', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'newsletter_title', __( 'Get ticket updates', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'newsletter_body', __( 'Invite visitors to subscribe for new departures, seasonal offers, and destination guides.', 'ocean-booking' ) ) ); ?></p>
			<form class="newsletter-form" action="#" method="post">
				<label class="screen-reader-text" for="newsletter-email"><?php esc_html_e( 'Email address', 'ocean-booking' ); ?></label>
				<input id="newsletter-email" type="email" placeholder="<?php esc_attr_e( 'Email address', 'ocean-booking' ); ?>">
				<button class="button button-primary" type="submit"><?php esc_html_e( 'Subscribe', 'ocean-booking' ); ?></button>
			</form>
		</aside>
	</div>
</section>

<section class="section final-cta">
	<div class="container split">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Support', 'ocean-booking' ); ?></p>
			<h2><?php echo esc_html( obt_theme_text( 'contact_cta_title', __( 'Questions before booking?', 'ocean-booking' ) ) ); ?></h2>
			<p><?php echo esc_html( obt_theme_text( 'contact_cta_body', __( 'Offer fast support through contact forms, WhatsApp, email, or your preferred customer service channel.', 'ocean-booking' ) ) ); ?></p>
		</div>
		<a class="button button-primary button-large" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Get support', 'ocean-booking' ); ?></a>
	</div>
</section>
<?php
get_footer();
