<?php
defined( 'ABSPATH' ) || exit;

define( 'INI_DENTAL_VERSION', '1.0.0' );
define( 'INI_DENTAL_DIR', get_template_directory() );
define( 'INI_DENTAL_URI', get_template_directory_uri() );

/* -----------------------------------------------------------------------
 * Require includes
 * -------------------------------------------------------------------- */
require_once INI_DENTAL_DIR . '/inc/helpers.php';
require_once INI_DENTAL_DIR . '/inc/customizer.php';
require_once INI_DENTAL_DIR . '/inc/section-manager.php';

/* -----------------------------------------------------------------------
 * Theme Setup
 * -------------------------------------------------------------------- */
add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'ini-dental', INI_DENTAL_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'ini-dental' ),
		'footer'  => __( 'Footer Menu', 'ini-dental' ),
	] );

	add_image_size( 'ini-hero',    800, 900,  true );
	add_image_size( 'ini-service', 600, 420,  true );
	add_image_size( 'ini-blog',    480, 360,  true );
	add_image_size( 'ini-avatar',  100, 100,  true );
	add_image_size( 'ini-about',   600, 660,  true );
} );

/* -----------------------------------------------------------------------
 * Enqueue Scripts & Styles
 * -------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', function () {
	// Google Fonts
	wp_enqueue_style(
		'ini-dental-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap',
		[],
		null
	);

	// Main theme stylesheet
	wp_enqueue_style(
		'ini-dental-theme',
		INI_DENTAL_URI . '/assets/css/theme.css',
		[ 'ini-dental-fonts' ],
		INI_DENTAL_VERSION
	);

	// Theme JS
	wp_enqueue_script(
		'ini-dental-theme',
		INI_DENTAL_URI . '/assets/js/theme.js',
		[],
		INI_DENTAL_VERSION,
		true
	);

	wp_localize_script( 'ini-dental-theme', 'iniDental', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'ini_dental_nonce' ),
	] );
} );

// Admin styles & scripts
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( strpos( $hook, 'ini-dental' ) === false && $hook !== 'post.php' && $hook !== 'post-new.php' ) {
		return;
	}

	wp_enqueue_style(
		'ini-dental-admin',
		INI_DENTAL_URI . '/assets/css/admin.css',
		[],
		INI_DENTAL_VERSION
	);

	wp_enqueue_script(
		'ini-dental-admin',
		INI_DENTAL_URI . '/assets/js/admin.js',
		[ 'jquery', 'jquery-ui-sortable' ],
		INI_DENTAL_VERSION,
		true
	);

	wp_localize_script( 'ini-dental-admin', 'iniDentalAdmin', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'ini_dental_admin_nonce' ),
	] );
} );

// Customizer preview JS
add_action( 'customize_preview_init', function () {
	wp_enqueue_script(
		'ini-dental-customizer-preview',
		INI_DENTAL_URI . '/assets/js/customizer-preview.js',
		[ 'customize-preview', 'jquery' ],
		INI_DENTAL_VERSION,
		true
	);
} );

/* -----------------------------------------------------------------------
 * Excerpt length
 * -------------------------------------------------------------------- */
add_filter( 'excerpt_length', fn() => 18 );
add_filter( 'excerpt_more', fn() => '&hellip;' );

/* -----------------------------------------------------------------------
 * Pagination helper
 * -------------------------------------------------------------------- */
function ini_dental_pagination() {
	$args = [
		'prev_text' => '&laquo; ' . __( 'Previous', 'ini-dental' ),
		'next_text' => __( 'Next', 'ini-dental' ) . ' &raquo;',
	];
	the_posts_pagination( $args );
}
