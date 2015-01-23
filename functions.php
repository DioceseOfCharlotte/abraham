<?php
/**
 * Abraham functions and definitions
 *
 * @package Abraham
 */

/* Get the template directory and make sure it has a trailing slash. */
$abraham_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and theme files. */
require_once( $abraham_dir . 'library/hybrid.php'             );
require_once( $abraham_dir . 'inc/tha-theme-hooks.php' );
require_once( $abraham_dir . 'inc/custom-background.php'      );
require_once( $abraham_dir . 'inc/custom-header.php'          );
require_once( $abraham_dir . 'inc/custom-colors.php'          );
require_once( $abraham_dir . 'inc/customizer.php'             );
require_once( $abraham_dir . 'inc/general.php'                );
require_once( $abraham_dir . 'inc/template-actions.php'       );
require_once( $abraham_dir . 'inc/hybrid-mods.php'            );
require_once( $abraham_dir . 'inc/google-analytics.php'       );

/* Launch the Hybrid Core framework. */
new Hybrid();

/* Set up the theme early. */
add_action( 'after_setup_theme', 'abraham_setup', 5 );

/**
 * Theme defaults and support for various WordPress & framework features.
 */
function abraham_setup() {

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

	/*  Per Post stylesheets. */
	add_theme_support( 'post-stylesheets' );

	/* Theme layouts. */
	add_theme_support( 'theme-layouts', array(
			'1c'    => __( 'Single Column', 'abraham' ),
			'2c-l'  => __( 'Sidebar Right', 'abraham' ),
			'2c-r'  => __( 'Sidebar Left', 'abraham' )
		),
		array( 'default' => 'sidebar-right' )
	);

	/* Post Formats. */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'status',
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



	function abraham_excerpt_more( $more ) {
		return '... <div class="read-more__fade"><a href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading...', 'abraham') . '</a></div>';
	}
	add_filter( 'excerpt_more', 'abraham_excerpt_more' );











add_filter( 'hybrid_comment_template_hierarchy', 'abe_comment_template_hierarchy' );

function abe_comment_template_hierarchy( $templates ) {


		$templates = array_merge( array( 'partials/comment.php' ), $templates );

	return $templates;
}
