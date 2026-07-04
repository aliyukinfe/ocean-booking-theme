<?php
/**
 * Theme setup.
 *
 * @package OceanBookingTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OBT_VERSION', '1.1.3' );

function obt_setup() {
	load_theme_textdomain( 'ocean-booking', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 72, 'width' => 240, 'flex-width' => true ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'ocean-booking' ),
			'footer'  => __( 'Footer Menu', 'ocean-booking' ),
		)
	);
	add_image_size( 'event-card', 720, 520, true );
}
add_action( 'after_setup_theme', 'obt_setup' );

function obt_assets() {
	wp_enqueue_style( 'obt-main', get_template_directory_uri() . '/assets/css/main.css', array(), OBT_VERSION );
	wp_enqueue_script( 'obt-main', get_template_directory_uri() . '/assets/js/main.js', array(), OBT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'obt_assets' );

function obt_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'obt_excerpt_length' );

function obt_event_query_args( $limit = 6 ) {
	return array(
		'post_type'      => 'event',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
}

function obt_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'ocean-booking' ) . '"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'ocean-booking' ) . '</a><span>/</span><span>' . esc_html( wp_get_document_title() ) . '</span></nav>';
}

function obt_menu_fallback( $args = array() ) {
	$theme_location = isset( $args['theme_location'] ) ? $args['theme_location'] : 'primary';
	$links = array(
		array( __( 'Home', 'ocean-booking' ), home_url( '/' ) ),
		array( __( 'Tickets', 'ocean-booking' ), get_post_type_archive_link( 'event' ) ),
		array( __( 'Destinations', 'ocean-booking' ), get_post_type_archive_link( 'event' ) ),
		array( __( 'Experiences', 'ocean-booking' ), get_post_type_archive_link( 'event' ) ),
		array( __( 'Guides', 'ocean-booking' ), get_post_type_archive_link( 'guide' ) ),
		array( __( 'About', 'ocean-booking' ), home_url( '/about/' ) ),
		array( __( 'Contact', 'ocean-booking' ), home_url( '/contact/' ) ),
	);

	if ( 'footer' === $theme_location ) {
		$links[] = array( __( 'FAQ', 'ocean-booking' ), home_url( '/faq/' ) );
		$links[] = array( __( 'Privacy Policy', 'ocean-booking' ), home_url( '/privacy-policy/' ) );
		$links[] = array( __( 'Terms', 'ocean-booking' ), home_url( '/terms/' ) );
		$links[] = array( __( 'Cookie Policy', 'ocean-booking' ), home_url( '/cookie-policy/' ) );
	}

	echo '<ul>';
	foreach ( $links as $link ) {
		if ( ! $link[1] ) {
			continue;
		}
		echo '<li><a href="' . esc_url( $link[1] ) . '">' . esc_html( $link[0] ) . '</a></li>';
	}
	echo '</ul>';
}

function obt_get_current_language_code() {
	if ( function_exists( 'pll_current_language' ) ) {
		return pll_current_language( 'slug' );
	}

	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		return ICL_LANGUAGE_CODE;
	}

	$query_lang = sanitize_key( wp_unslash( $_GET['lang'] ?? '' ) );
	if ( $query_lang ) {
		return $query_lang;
	}

	return substr( determine_locale(), 0, 2 );
}

function obt_language_switcher() {
	$current = obt_get_current_language_code();

	if ( function_exists( 'pll_the_languages' ) ) {
		$languages = pll_the_languages( array( 'raw' => 1 ) );
		if ( $languages ) {
			echo '<ul class="language-switcher-list">';
			foreach ( $languages as $language ) {
				$slug = sanitize_key( $language['slug'] ?? '' );
				echo '<li><a class="' . esc_attr( $slug === $current ? 'is-current' : '' ) . '" href="' . esc_url( $language['url'] ?? home_url( '/' ) ) . '">' . esc_html( strtoupper( $slug ) ) . '</a></li>';
			}
			echo '</ul>';
			return;
		}
	}

	$wpml_languages = apply_filters( 'wpml_active_languages', null, array( 'skip_missing' => 0 ) );
	if ( is_array( $wpml_languages ) && $wpml_languages ) {
		echo '<ul class="language-switcher-list">';
		foreach ( $wpml_languages as $language ) {
			$code = sanitize_key( $language['language_code'] ?? '' );
			echo '<li><a class="' . esc_attr( ! empty( $language['active'] ) ? 'is-current' : '' ) . '" href="' . esc_url( $language['url'] ?? home_url( '/' ) ) . '">' . esc_html( strtoupper( $code ) ) . '</a></li>';
		}
		echo '</ul>';
		return;
	}

	if ( function_exists( 'trp_custom_language_switcher' ) ) {
		$languages = trp_custom_language_switcher();
		if ( is_array( $languages ) && $languages ) {
			echo '<ul class="language-switcher-list">';
			foreach ( $languages as $language ) {
				$code = sanitize_key( $language['short_language_name'] ?? $language['language_code'] ?? '' );
				$url  = $language['current_page_url'] ?? $language['url'] ?? home_url( '/' );
				echo '<li><a class="' . esc_attr( $code === $current ? 'is-current' : '' ) . '" href="' . esc_url( $url ) . '">' . esc_html( strtoupper( $code ) ) . '</a></li>';
			}
			echo '</ul>';
			return;
		}
	}

	if ( shortcode_exists( 'language-switcher' ) ) {
		echo do_shortcode( '[language-switcher]' );
		return;
	}

	$fallback_languages = array(
		'en' => __( 'English', 'ocean-booking' ),
		'de' => __( 'German', 'ocean-booking' ),
		'fr' => __( 'French', 'ocean-booking' ),
		'it' => __( 'Italian', 'ocean-booking' ),
		'es' => __( 'Spanish', 'ocean-booking' ),
	);

	echo '<ul class="language-switcher-list language-switcher-fallback">';
	foreach ( $fallback_languages as $code => $label ) {
		echo '<li><a class="' . esc_attr( $code === $current ? 'is-current' : '' ) . '" href="' . esc_url( add_query_arg( 'lang', $code ) ) . '" title="' . esc_attr( $label ) . '">' . esc_html( strtoupper( $code ) ) . '</a></li>';
	}
	echo '</ul>';
}

function obt_meta_description() {
	if ( is_singular( 'event' ) && function_exists( 'obc_get_event_meta' ) ) {
		$description = obc_get_event_meta( get_the_ID(), 'meta_description' );
		$title       = obc_get_event_meta( get_the_ID(), 'meta_title' );
		$og          = obc_get_event_meta( get_the_ID(), 'og_image_url' );
		if ( $title ) {
			echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		}
		if ( $description ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
		}
		if ( $og ) {
			echo '<meta property="og:image" content="' . esc_url( $og ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'obt_meta_description', 5 );

function obt_filter_event_archive( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'event' ) ) {
		return;
	}

	$tax_query = array();
	foreach ( array( 'event_location', 'event_category' ) as $taxonomy ) {
		$slug = sanitize_text_field( wp_unslash( $_GET[ $taxonomy ] ?? '' ) );
		if ( $slug ) {
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $slug,
			);
		}
	}
	if ( $tax_query ) {
		$query->set( 'tax_query', $tax_query );
	}

	$sort = sanitize_text_field( wp_unslash( $_GET['sort'] ?? 'newest' ) );
	if ( 'price' === $sort ) {
		$query->set( 'meta_key', '_obc_price_from' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
	} elseif ( 'popular' === $sort ) {
		$query->set( 'orderby', 'comment_count' );
		$query->set( 'order', 'DESC' );
	}
}
add_action( 'pre_get_posts', 'obt_filter_event_archive' );

function obt_theme_text( $key, $default ) {
	return get_theme_mod( 'obt_' . $key, $default );
}

function obt_theme_image( $key, $default = '' ) {
	$image = get_theme_mod( 'obt_' . $key );
	return $image ? $image : $default;
}

function obt_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'obt_home',
		array(
			'title'    => __( 'Home Page Content', 'ocean-booking' ),
			'priority' => 35,
		)
	);

	$settings = array(
		'hero_eyebrow'       => __( 'Ocean tickets and guided experiences', 'ocean-booking' ),
		'hero_title'         => __( 'Book unforgettable ocean experiences', 'ocean-booking' ),
		'hero_body'          => __( 'Browse premium tickets, compare details, and continue to a secure provider checkout from any device.', 'ocean-booking' ),
		'hero_review'        => __( 'A seamless way to discover, compare, and book memorable travel experiences.', 'ocean-booking' ),
		'hero_review_name'   => __( 'Verified traveler', 'ocean-booking' ),
		'featured_title'     => __( 'Featured tickets', 'ocean-booking' ),
		'featured_body'      => __( 'Highlight your best-selling experiences and seasonal offers from the WordPress event manager.', 'ocean-booking' ),
		'upcoming_title'     => __( 'Upcoming departures', 'ocean-booking' ),
		'popular_title'      => __( 'Popular tickets', 'ocean-booking' ),
		'destinations_title' => __( 'Explore destinations', 'ocean-booking' ),
		'destinations_body'  => __( 'Organize tickets by locations, harbors, beaches, cities, or regions.', 'ocean-booking' ),
		'why_title'          => __( 'Why book with us', 'ocean-booking' ),
		'why_body'           => __( 'Give guests the details they need before booking, with real checkout integration and translated content.', 'ocean-booking' ),
		'how_title'          => __( 'How booking works', 'ocean-booking' ),
		'how_body'           => __( 'A simple three-step flow keeps guests confident from discovery to confirmation.', 'ocean-booking' ),
		'reviews_title'      => __( 'Guest confidence, built in', 'ocean-booking' ),
		'faq_title'          => __( 'Booking questions', 'ocean-booking' ),
		'newsletter_title'   => __( 'Get ticket updates', 'ocean-booking' ),
		'newsletter_body'    => __( 'Invite visitors to subscribe for new departures, seasonal offers, and destination guides.', 'ocean-booking' ),
		'contact_cta_title'  => __( 'Questions before booking?', 'ocean-booking' ),
		'contact_cta_body'   => __( 'Offer fast support through contact forms, WhatsApp, email, or your preferred customer service channel.', 'ocean-booking' ),
		'destination_1_title' => __( 'Island Escapes', 'ocean-booking' ),
		'destination_1_count' => __( '12 experiences', 'ocean-booking' ),
		'destination_2_title' => __( 'Coastal Tours', 'ocean-booking' ),
		'destination_2_count' => __( '18 experiences', 'ocean-booking' ),
		'destination_3_title' => __( 'Harbor Nights', 'ocean-booking' ),
		'destination_3_count' => __( '9 experiences', 'ocean-booking' ),
		'review_1_text'      => __( 'The site makes it simple to compare experiences, check details, and book on mobile without confusion.', 'ocean-booking' ),
		'review_1_name'      => __( 'Maya R.', 'ocean-booking' ),
		'review_1_country'   => __( 'Germany', 'ocean-booking' ),
		'review_2_text'      => __( 'Beautiful presentation, clear meeting information, and a checkout path that feels trustworthy.', 'ocean-booking' ),
		'review_2_name'      => __( 'Luca P.', 'ocean-booking' ),
		'review_2_country'   => __( 'Italy', 'ocean-booking' ),
		'review_3_text'      => __( 'Exactly the kind of polished ticket experience guests expect from a premium travel brand.', 'ocean-booking' ),
		'review_3_name'      => __( 'Sofia M.', 'ocean-booking' ),
		'review_3_country'   => __( 'Spain', 'ocean-booking' ),
		'gallery_1_label'    => __( 'Ocean tours', 'ocean-booking' ),
		'gallery_2_label'    => __( 'Beach clubs', 'ocean-booking' ),
		'gallery_3_label'    => __( 'Boat activities', 'ocean-booking' ),
		'gallery_4_label'    => __( 'Travel moments', 'ocean-booking' ),
		'faq_1_question'     => __( 'Can I replace the images?', 'ocean-booking' ),
		'faq_1_answer'       => __( 'Yes. The hero, destination, gallery, and contact images are editable in the WordPress Customizer.', 'ocean-booking' ),
		'faq_2_question'     => __( 'Where do tickets come from?', 'ocean-booking' ),
		'faq_2_answer'       => __( 'Tickets are managed as Events in WordPress and can connect to your real booking provider.', 'ocean-booking' ),
		'faq_3_question'     => __( 'Does this support multiple languages?', 'ocean-booking' ),
		'faq_3_answer'       => __( 'Yes. All theme strings are translation-ready and the structure works with Polylang, WPML, or TranslatePress.', 'ocean-booking' ),
	);

	foreach ( $settings as $key => $default ) {
		$wp_customize->add_setting( 'obt_' . $key, array( 'default' => $default, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'obt_' . $key, array( 'section' => 'obt_home', 'label' => ucwords( str_replace( '_', ' ', $key ) ), 'type' => 'text' ) );
	}

	$image_settings = array(
		'hero_image'        => __( 'Hero background image', 'ocean-booking' ),
		'destination_1_img' => __( 'Destination image 1', 'ocean-booking' ),
		'destination_2_img' => __( 'Destination image 2', 'ocean-booking' ),
		'destination_3_img' => __( 'Destination image 3', 'ocean-booking' ),
		'gallery_1_img'     => __( 'Gallery image 1', 'ocean-booking' ),
		'gallery_2_img'     => __( 'Gallery image 2', 'ocean-booking' ),
		'gallery_3_img'     => __( 'Gallery image 3', 'ocean-booking' ),
		'gallery_4_img'     => __( 'Gallery image 4', 'ocean-booking' ),
		'contact_bg_img'    => __( 'Contact CTA background image', 'ocean-booking' ),
	);

	foreach ( $image_settings as $key => $label ) {
		$wp_customize->add_setting( 'obt_' . $key, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'obt_' . $key, array( 'section' => 'obt_home', 'label' => $label ) ) );
	}
}
add_action( 'customize_register', 'obt_customize_register' );
