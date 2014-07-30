<?php
/**
 * Abraham functions and definitions
 *
 * @package Abraham
 */

/* Get the template directory and make sure it has a trailing slash. */
$abraham_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and theme files. */
require_once( $abraham_dir . 'library/hybrid.php'        );
require_once( $abraham_dir . 'inc/custom-background.php' );
require_once( $abraham_dir . 'inc/custom-header.php'     );
require_once( $abraham_dir . 'inc/theme.php'             );
require_once( $abraham_dir . 'inc/hybrid-mods.php'       );

/* Launch the Hybrid Core framework. */
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'abraham_theme_setup', 5 );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_theme_setup() {

	/* Theme layouts. */
	add_theme_support( 
		'theme-layouts', 
		array(
			'1c'        => __( '1 Column',                     'abraham' ),
			'2c-l'      => __( '2 Columns: Content / Sidebar', 'abraham' ),
			'2c-r'      => __( '2 Columns: Sidebar / Content', 'abraham' ),
			'3c-l'      => __( '3 Columns: Content / Sidebar / Sidebar', 'abraham' ),
			'3c-r'      => __( '3 Columns: Sidebar / Sidebar / Content', 'abraham' ),
			'3c-c'      => __( '3 Columns: Sidebar / Content / Sidebar', 'abraham' )
		),
		array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) 
	);

		/* Load stylesheets. */
	add_theme_support(
		'hybrid-core-styles',
		array( 'meh-fonts', 'meh-font-awesome', 'parent', 'style' )
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Breadcrumbs. Yay! */
	add_theme_support( 'breadcrumb-trail' );

	/* Pagination. */
	add_theme_support( 'loop-pagination' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	add_theme_support( 'site-logo' );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 1280 );
}
