<?php
/*
Theme Name: Abraham
Theme URI: https://github.com/m-e-h/abraham
Author: Marty Helmick
Author URI: https://github.com/m-e-h
Description: Experimental WP parent theme.
Version: 1.0-wpcom
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ahabraham
Tags:

This theme, like WordPress, is licensed under the GPL.

 Abraham is based on Stargazer http://themehybrid.com/themes/stargazer, (C) 2013-2014, Justin Tadlock.
*/

/* Get the template directory and make sure it has a trailing slash. */
$abraham_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and launch it. */
require_once( $abraham_dir . 'library/hybrid.php' );
new Hybrid();

/* Load theme-specific files. */
require_once( $abraham_dir . 'inc/custom-background.php'     );
require_once( $abraham_dir . 'inc/custom-header.php'         );
require_once( $abraham_dir . 'inc/custom-colors.php'         );
require_once( $abraham_dir . 'inc/hybrid-mods.php'         );

/* Set up the theme early. */
add_action( 'after_setup_theme', 'abraham_theme_setup', 5 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_theme_setup() {

	/* Load files. */
	require_once( trailingslashit( get_template_directory() ) . 'inc/abraham.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customize.php' );

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Theme layouts. */
	add_theme_support(
		'theme-layouts',
		array(
			'1c'        => __( '1 Column Wide',                'abraham' ),
			'1c-narrow' => __( '1 Column Narrow',              'abraham' ),
			'2c-l'      => __( '2 Columns: Content / Sidebar', 'abraham' ),
			'2c-r'      => __( '2 Columns: Sidebar / Content', 'abraham' )
		),
		array( 'default' => is_rtl() ? '2c-r' :'2c-l' )
	);

	/* Load stylesheets. */
	add_theme_support(
		'hybrid-core-styles',
		array( 'abraham-fonts', 'gallery', 'abraham-mediaelement', 'parent', 'style' )
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

	/* Whistles plugin. */
	add_theme_support( 'whistles', array( 'styles' => true ) );

	/* Post formats. */
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	/* Editor styles. */
	add_editor_style( abraham_get_editor_styles() );

	/* Handle content width for embeds and images. */
	// Note: this is the largest size based on the theme's various layouts.
	hybrid_set_content_width( 1025 );
}
