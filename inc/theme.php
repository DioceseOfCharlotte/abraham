<?php

/* Register custom image sizes. */
add_action( 'init', 'hybrid_base_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'hybrid_base_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'hybrid_base_register_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_styles', 5 );

/**
 * Registers custom image sizes for the theme. 
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	//set_post_thumbnail_size( 150, 150, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_menus() {
	register_nav_menu( 'primary',    _x( 'Primary',    'nav menu location', 'hybrid-base' ) );
	register_nav_menu( 'secondary',  _x( 'Secondary',  'nav menu location', 'hybrid-base' ) );
	register_nav_menu( 'social', 		 _x( 'Social', 'nav menu location', 'hybrid-base' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary Sidebar', 'sidebar', 'hybrid-base' ),
			'description' => __( 'Typically on the screens left side.', 'hybrid-base' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'secondary',
			'name'        => _x( 'Secondary Sidebar', 'sidebar', 'hybrid-base' ),
			'description' => __( 'Typically on the screens right side.', 'hybrid-base' )
		)
	);

		hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => _x( 'Footer Widget Area', 'sidebar', 'hybrid-base' ),
			'description' => __( 'Footer widgets.', 'hybrid-base' )
		)
	);
}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_scripts() {

	wp_register_script( 'meh', trailingslashit( get_template_directory_uri() ) . "scripts/main.js", array(), null, true );

  wp_enqueue_script( 'meh' );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_styles() {

	/* Register Google-fonts. */
	wp_register_style( 'meh-fonts', '//fonts.googleapis.com/css?family=RobotoDraft:300,400,500|Source+Code+Pro:400,700' );

	/* Register Font Awesome. */
	wp_register_style( 'meh-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	/* Gets ".min" suffix. */
	$suffix = hybrid_get_min_suffix();

	/* Load gallery style if 'cleaner-gallery' is active. */
	if ( current_theme_supports( 'cleaner-gallery' ) ) {
		wp_enqueue_style( 'gallery', trailingslashit( HYBRID_CSS ) . "gallery{$suffix}.css" );
	}

	/* Load parent theme stylesheet if child theme is active. */
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );
	}

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
