<?php

/* Set up the theme early. */
add_action( 'after_setup_theme', 'abraham_setup', 5 );

/* Register custom menus. */
add_action( 'init', 'abraham_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_sidebars', 5 );



/**
 * Theme defaults and support for various WordPress & framework features.
 */
function abraham_setup() {

	/* Remove unwanted default Hybrid head elements. */
remove_action( 'wp_head', 'hybrid_meta_template', 1 );
remove_action( 'wp_head', 'hybrid_link_pingback', 3 );
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_generator', 1);
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'rsd_link');

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
	add_theme_support( 'theme-layouts', [
			'1c'    => __( 'Single Column', 'abraham' ),
			'2c-l'  => __( 'Sidebar Right', 'abraham' ),
			'2c-r'  => __( 'Sidebar Left', 'abraham' )
		],
		[ 'default' => '2c-l' ]
	);

	/* Post Formats. */
	add_theme_support( 'post-formats', [
		'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'status',
		'video'
	] );
}

function abraham_menus() {
	register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'abraham' ) );
	register_nav_menu( 'social',  _x( 'Social',  'nav menu location', 'abraham' ) );
}

function abraham_sidebars() {
	hybrid_register_sidebar( [
		'id'          => 'primary',
		'name'        => _x( 'Primary', 'sidebar', 'abraham' ),
		'description' => __( 'The Primary sidebar.', 'abraham' )
	] );

	hybrid_register_sidebar( [
		'id'          => 'footer-widgets',
		'name'        => _x( 'Footer Widgets', 'sidebar', 'abraham' ),
		'description' => __( 'Typically located in the footer.', 'abraham' )
	] );
}
