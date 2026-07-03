<?php
/**
 * Theme setup.
 *
 * @package OceanBookingTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OBT_VERSION', '1.0.0' );

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
		array( __( 'Tickets', 'ocean-booking' ), get_post_type_archive_link( 'event' ) ),
		array( __( 'Guides', 'ocean-booking' ), get_post_type_archive_link( 'guide' ) ),
		array( __( 'FAQ', 'ocean-booking' ), home_url( '/faq/' ) ),
		array( __( 'Contact', 'ocean-booking' ), home_url( '/contact/' ) ),
	);

	if ( 'footer' === $theme_location ) {
		$links[] = array( __( 'Privacy Policy', 'ocean-booking' ), home_url( '/privacy-policy/' ) );
		$links[] = array( __( 'Terms', 'ocean-booking' ), home_url( '/terms/' ) );
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
	);

	foreach ( $settings as $key => $default ) {
		$wp_customize->add_setting( 'obt_' . $key, array( 'default' => $default, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'obt_' . $key, array( 'section' => 'obt_home', 'label' => ucwords( str_replace( '_', ' ', $key ) ), 'type' => 'text' ) );
	}

	$wp_customize->add_setting( 'obt_hero_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'obt_hero_image', array( 'section' => 'obt_home', 'label' => __( 'Hero background image', 'ocean-booking' ) ) ) );
}
add_action( 'customize_register', 'obt_customize_register' );
