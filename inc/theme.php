<?php

/* Register custom image sizes. */
add_action( 'init', 'abraham_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'abraham_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_register_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'abraham_enqueue_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'abraham_enqueue_styles', 5 );

/**
 * Registers custom image sizes for the theme. 
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	set_post_thumbnail_size( 150, 150, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_register_menus() {
	register_nav_menu( 'primary',    _x( 'Primary',    'nav menu location', 'abraham' ) );
	register_nav_menu( 'secondary',  _x( 'Secondary',  'nav menu location', 'abraham' ) );
	register_nav_menu( 'social', 		 _x( 'Social', 'nav menu location', 'abraham' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary Sidebar', 'sidebar', 'abraham' ),
			'description' => __( 'Typically on the screens left side.', 'abraham' ),
			'before_title'  => '<h2 class="primary-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<section id="%1$s" class="primary widget %2$s">',
			'after_widget'  => '</section>',
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'secondary',
			'name'        => _x( 'Secondary Sidebar', 'sidebar', 'abraham' ),
			'description' => __( 'Typically on the screens right side.', 'abraham' ),
			'before_title'  => '<h2 class="secondary-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<section id="%1$s" class="secondary widget %2$s">',
			'after_widget'  => '</section>',
		)
	);

		hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => _x( 'Footer Widget Area', 'sidebar', 'abraham' ),
			'description' => __( 'Footer widgets.', 'abraham' ),
			'before_title'  => '<h2 class="subsidiary-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<section id="%1$s" class="subsidiary widget %2$s">',
			'after_widget'  => '</section>',
		)
	);

		hybrid_register_sidebar(
		array(
			'id'            => 'featured',
			'name'          => _x( 'Home Features', 'sidebar', 'abraham' ),
			'description'   => __( 'Add services or features you\'d like to highlight.', 'abraham' ),
			'before_title'  => '<h2 class="feature-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<section id="%1$s" class="%1$s feature widget %2$s">',
			'after_widget'  => '</section>',
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
function abraham_enqueue_scripts() {

	wp_register_script( 'meh-mainjs', trailingslashit( get_template_directory_uri() ) . "scripts/main.js", array(), null, true );

  wp_enqueue_script( 'meh-mainjs' );

  // 	wp_register_script( 'meh-slider', trailingslashit( get_template_directory_uri() ) . "scripts/jquery.flexslider.js", array( 'jquery' ), null, true );

  // wp_enqueue_script( 'meh-slider' );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_enqueue_styles() {

	/* Register Google-fonts. */
	wp_register_style( 'meh-fonts', '//fonts.googleapis.com/css?family=RobotoDraft:300,400,500|Fira+Sans:300,400,500,700|Source+Code+Pro:400,700' );

	/* Register Font Awesome. */
	wp_register_style( 'meh-font-awesome', '//fontastic.s3.amazonaws.com/fPqC5US3TztqZdfynZTmYQ/icons.css' );

	/* Register Fontastic Icons. */
	wp_register_style( 'meh-fontastic', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

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
