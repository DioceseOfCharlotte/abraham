<?php
/**
 * Scratch functions and definitions
 *
 * @package Scratch
 */

/* Get the template directory and make sure it has a trailing slash. */
$scratch_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and theme files. */
require_once( $scratch_dir . 'library/hybrid.php'             );
require_once( $scratch_dir . 'inc/vendor/tha-theme-hooks.php' );
require_once( $scratch_dir . 'inc/custom-background.php'      );
require_once( $scratch_dir . 'inc/custom-header.php'          );
require_once( $scratch_dir . 'inc/custom-colors.php'          );
require_once( $scratch_dir . 'inc/customizer.php'             );
require_once( $scratch_dir . 'inc/template-tags.php'          );
require_once( $scratch_dir . 'inc/general.php'                );
require_once( $scratch_dir . 'inc/template-actions.php'       );
require_once( $scratch_dir . 'inc/hybrid-mods.php'            );

/* Launch the Hybrid Core framework. */
new Hybrid();

/* Set up the theme early. */
add_action( 'after_setup_theme', 'scratch_setup', 5 );

/**
 * Theme defaults and support for various WordPress & framework features.
 */
function scratch_setup() {

	/* Let WordPress manage the document title. */
	add_theme_support( 'title-tag' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/*  Post Thumbnails on posts and pages. */
	add_theme_support( 'post-thumbnails' );

	/* Theme layouts. */
	add_theme_support( 'theme-layouts', array(
			'1c'    => __( 'Single Column', 'platform' ),
			'2c-l'  => __( 'Sidebar Right', 'platform' ),
			'2c-r'  => __( 'Sidebar Left', 'platform' )
		),
		array( 'default' => '2c-l' )
	);

	/* Post Formats. */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status',
		'video'
	) );
}

/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}


/* Remove unwanted default Hybrid head elements. */
remove_action( 'wp_head', 'hybrid_doctitle',      0 );
remove_action( 'wp_head', 'hybrid_meta_template', 1 );
remove_action( 'wp_head', 'hybrid_link_pingback', 3 );



	function scratch_excerpt_more( $more ) {
		return '... <div class="read-more__fade"><a href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading...', 'scratch') . '</a></div>';
	}
	add_filter( 'excerpt_more', 'scratch_excerpt_more' );
