<?php

/* Register custom image sizes. */
add_action( 'init', 'abraham_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'abraham_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_widgets_init', 5 );

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
	add_image_size( 'medium-square', 300, 300, true );
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
	register_nav_menu( 'social', 		 _x( 'Social',     'nav menu location', 'abraham' ) );
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function abraham_widgets_init() {

	hybrid_register_sidebar( array(
		'id'            => 'sidebar-1',
		'name'          => _x( 'Primary Sidebar', 'sidebar', 'abraham' ),
		'description'   => __( 'Typically on the screens left side.', 'abraham' ),
		'before_title'  => '<h2 class="primary-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<section id="%1$s" class="primary widget %2$s">',
		'after_widget'  => '</section>',
	) );

	hybrid_register_sidebar( array(
		'name'          => _x( 'Secondary Sidebar', 'sidebar', 'abraham' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

		hybrid_register_sidebar( array(
		'id'            => 'sidebar-3',
		'name'          => _x( 'Footer Widget Area', 'sidebar', 'abraham' ),
		'description'   => __( 'Footer widgets.', 'abraham' ),
		'before_title'  => '<h2 class="subsidiary-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<section id="%1$s" class="subsidiary widget %2$s">',
		'after_widget'  => '</section>',
	) );
}

/**
 * Enqueue scripts and styles.
 */
function abraham_scripts() {
	wp_enqueue_style( 'abraham-style', get_stylesheet_uri() );

	wp_enqueue_script( 'abraham-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'abraham-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'abraham_scripts' );


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
	wp_register_style( 'meh-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	/* Register Fontastic Icons. */
	//wp_register_style( 'meh-fontastic', '//fontastic.s3.amazonaws.com/fPqC5US3TztqZdfynZTmYQ/icons.css' );

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
