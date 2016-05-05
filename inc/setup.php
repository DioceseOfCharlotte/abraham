<?php
/**
 * Theme Setup.
 *
 * @package Abraham
 */

add_action( 'after_setup_theme', 'abraham_setup', 5 );
add_action( 'after_setup_theme', 'abraham_content_width', 0 );
add_action( 'wp_enqueue_scripts', 'abraham_assets' );
add_action( 'widgets_init', 'abraham_widgets', 5 );
add_action( 'init', 'abraham_image_sizes', 5 );
add_action( 'hybrid_register_layouts', 'abraham_layouts' );
add_filter( 'show_admin_bar' , 'abe_show_admin_bar');


function abe_show_admin_bar( $content ) {
	return defined( 'WP_DEBUG' ) && WP_DEBUG ? $content : false;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function abraham_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'breadcrumb-trail' );

	add_theme_support( 'get-the-image' );

	add_theme_support( 'hybrid-core-template-hierarchy' );

	add_theme_support( 'theme-layouts', array( 'default' => '1-column' ) );

	register_nav_menus(array(
		'primary'   => esc_html__( 'Primary', 'abraham' ),
	));

	add_theme_support('post-formats', array(
		'gallery',
		'link',
		'image',
		'quote',
		'video',
		'audio',
	));

	/*
	 * Enable support for custom logo.
	 *
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 150,
		'flex-width' => true,
	) );

	// Tell the TinyMCE editor to use a custom stylesheet.
	add_editor_style( abraham_get_editor_styles() );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function abraham_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 1184 );
}

/**
 * Scripts and stylesheets
 */
function abraham_assets() {
	$suffix = hybrid_get_min_suffix();

	// Styles.
	wp_enqueue_style(
		'material-icons',
		'https://fonts.googleapis.com/icon?family=Material+Icons'
	);

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'hybrid-parent' );
	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );

	// Scripts.
	wp_enqueue_script(
		'polyfill_js',
		'https://cdn.polyfill.io/v2/polyfill.min.js',
		false, false, true
	);

	// wp_enqueue_script(
	// 	'abraham_js',
	// 	trailingslashit( get_template_directory_uri() )."js/abraham{$suffix}.js",
	// 	false, false, true
	// );
	wp_enqueue_style( 'oldie', trailingslashit( get_template_directory_uri() )."css/oldie{$suffix}.css", array( 'hybrid-style' ) );
	wp_style_add_data( 'oldie', 'conditional', 'IE' );

	wp_enqueue_script( 'flexibility', trailingslashit( get_template_directory_uri() ).'js/flexibility.js',  false, false, false );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );
}

/**
 * Styles for the editor.
 */
function abraham_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'style.css';
	$editor_styles[] = str_replace( ',', '%2C', '//fonts.googleapis.com/icon?family=Material+Icons' );

	/* If a child theme, add its editor styles. */
	if ( is_child_theme() ) {
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'style.css'; }

	/* Return the styles. */
	return $editor_styles;
}

if ( ! function_exists( 'abraham_widgets' ) ) {

	/**
	 * Register sidebars.
	 */
	function abraham_widgets() {
		register_sidebar(array(
			'id'            => 'primary',
			'name'          => __( 'Primary', 'abraham' ),
			'before_title'  => '<h3 class="h2 widget-title u-mt0">',
			'after_title'   => '</h3>',
			'before_widget' => '<section ' .hybrid_get_attr( 'widgets', 'primary' ).'>',
			'after_widget'  => '</section>',
		));

		register_sidebar(array(
			'id'            => 'footer',
			'name'          => __( 'Footer', 'abraham' ),
			'before_title'  => '<h3 class="h2 widget-title u-mt0">',
			'after_title'   => '</h3>',
			'before_widget' => '<section ' .hybrid_get_attr( 'widgets', 'footer' ).'>',
			'after_widget'  => '</section>',
		));
	}
}

/**
 * Create additional sizes.
 */
function abraham_image_sizes() {
	add_image_size( 'abe-hd', 1200, 675, true );
	add_image_size( 'abe-hd-half', 1200, 338, true );
	add_image_size( 'abe-card-md', 660, 371, true );
	add_image_size( 'abe-card', 330, 186, true );
	add_image_size( 'abe-icon', 80, 80, true );
}

/**
 * Hybrid Theme Layouts
 */
function abraham_layouts() {

	hybrid_register_layout('1-column', array(
		'label'            => _x( 'Single Column', 'theme layout', 'abraham' ),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column.svg',
	));

	hybrid_register_layout('1-column-wide', array(
		'label'            => _x( 'Single Column Wide', 'theme layout', 'abraham' ),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column-wide.svg',
	));

	hybrid_register_layout('sidebar-right', array(
		'label'            => _x( 'Sidebar Right', 'theme layout', 'abraham' ),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-right.svg',
	));

	hybrid_register_layout('sidebar-left', array(
		'label'            => _x( 'Sidebar Left', 'theme layout', 'abraham' ),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-left.svg',
	));
}
