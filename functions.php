<?php
/**
 * Abraham functions and definitions
 *
 * @package Abraham
 */

/* Get the template directory and make sure it has a trailing slash. */
$abraham_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and theme files. */
require_once( $abraham_dir . 'hybrid/hybrid.php'    );
require_once( $abraham_dir . 'inc/custom-background.php' );
require_once( $abraham_dir . 'inc/custom-header.php'     );
//require_once( $abraham_dir . 'inc/custom-colors.php'     );
require_once( $abraham_dir . 'inc/theme.php'             );
require_once( $abraham_dir . 'inc/customizer.php'        );
require_once( $abraham_dir . 'inc/template-tags.php'     );
require_once( $abraham_dir . 'inc/hybrid-mods.php'      );

/* Launch the Hybrid Core framework. */
new Hybrid();

/* Remove these two lines if not using the extra functions */
require_once( $abraham_dir . 'abe-extras/diocese.php'  );
new Diocese();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'abraham_setup' );

if ( ! function_exists( 'abraham_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function abraham_setup() {

		/* Staff Directory. */
	add_theme_support( 'diocese-employees' );

	/* Department Directory. */
	add_theme_support( 'diocese-departments' );

	/* Document Directory. */
	add_theme_support( 'diocese-documents' );


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable custom template hierarchy.
	 * See http://themehybrid.com/docs/template-hierarchy
	 */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/*
	 * Enable custom thumbnail/image script.
	 * See http://themehybrid.com/docs/get-the-image
	 */
	add_theme_support( 'get-the-image' );

	/*
	 * Enable custom breadcrumbs.
	 * See http://themehybrid.com/docs/breadcrumb-trail
	 */
	add_theme_support( 'breadcrumb-trail' );

	/*
	 * Enable paginated numbers for multi-posts.
	 * See http://themehybrid.com/docs/loop-pagination
	 */
	add_theme_support( 'loop-pagination' );

  /*
   * Load stylesheets.
   * See http://themehybrid.com/docs/theme-layouts
   */
  add_theme_support(
    'hybrid-core-styles',
    array( 'meh-fonts', 'meh-font-awesome', 'parent', 'style',
  ) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link',
	) );

	/*
	 * Enable support for Theme layouts.
	 * See http://themehybrid.com/docs/theme-layouts
	 */
	add_theme_support( 'theme-layouts',	array(
		'1c'        => __( '1 Column',                     'hybrid-base' ),
		'2c-l'      => __( '2 Columns: Content / Sidebar', 'hybrid-base' ),
		'2c-r'      => __( '2 Columns: Sidebar / Content', 'hybrid-base' )
	), array(
		'default' => '2c-l'
		) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'abraham_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // abraham_setup
