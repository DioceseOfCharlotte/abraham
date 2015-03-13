<?php
/**
 * Abraham functions and definitions
 *
 * @package Abraham
 */


/* Include Hybrid Core. */
require_once( trailingslashit( get_template_directory() ) . 'hybrid/hybrid.php' );
new Hybrid();

/* Set up the theme early. */
add_action( 'after_setup_theme', 'abraham_setup', 5 );

/* Require included files early too. */
add_action( 'after_setup_theme', 'abraham_includes', 10 );




/**
 * Theme defaults and support for various WordPress & framework features.
 */
function abraham_setup() {

	/* Remove unwanted default Hybrid head elements. */
	remove_action( 'wp_head', 'hybrid_link_pingback', 3 );
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'wp_generator', 1);
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action( 'wp_head', 'rsd_link');

	// http://themehybrid.com/docs/hybrid_set_content_width
	hybrid_set_content_width( 1140 );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Display a logo in the header. */
	add_theme_support( 'site-logo' );

	/* Breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/*  Post Thumbnails on posts and pages. */
	add_theme_support( 'post-thumbnails' );

	/*  Per Post stylesheets. */
	add_theme_support( 'post-stylesheets' );

	/* Theme layouts. */
	add_theme_support(
		'theme-layouts',
		[
			'1c-narrow' => __( 'Single Column', 'abraham' ),
			'1c'    	=> __( 'Single Wide', 'abraham' ),
			'2c-l'  	=> __( 'Sidebar Right', 'abraham' ),
			'2c-r'  	=> __( 'Sidebar Left', 'abraham' )
		],
		[ 'default' => '2c-l' ]
	);

	/* Post Formats. */
	add_theme_support(
		'post-formats',
		[
			'aside',
			'audio',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		]
	);
}




/**
 * Load all required theme files.
 *
 * @since   1.0.0
 * @return  void
 */
function abraham_includes() {

/* Load theme files. */
$includes_dir = trailingslashit( get_template_directory() ) . 'inc/';

require_once $includes_dir . 'init.php';
require_once $includes_dir . 'assets.php';
require_once $includes_dir . 'general.php';
require_once $includes_dir . 'template-actions.php';
require_once $includes_dir . 'css-classes.php';
require_once $includes_dir . 'html-min.php';

/* Load customizer files. */
$customizer_dir = trailingslashit( $includes_dir . 'customizer' );

require_once $customizer_dir . 'custom-background.php';
require_once $customizer_dir . 'custom-header.php';
require_once $customizer_dir . 'customizer.php';

/* Load 3rd party files. */
$vendors_dir = trailingslashit( $includes_dir . 'vendors' );

require_once $vendors_dir . 'flagship-library/flagship-library.php';
require_once $vendors_dir . 'tha-theme-hooks.php';
require_once $vendors_dir . 'google-analytics.php';
}
