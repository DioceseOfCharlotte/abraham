<?php
/*
 * Theme setup
 */

add_action('after_setup_theme', 'abraham_setup', 5);
add_action('wp_enqueue_scripts', 'abraham_assets');
add_action('widgets_init', 'abraham_widgets', 5);
add_action('init', 'abraham_image_sizes', 5);
add_action('hybrid_register_layouts', 'abraham_layouts');

function abraham_setup() {

	// http://codex.wordpress.org/Automatic_Feed_Links
	add_theme_support('automatic-feed-links');

	// https://github.com/justintadlock/breadcrumb-trail
	add_theme_support('breadcrumb-trail');

	// https://github.com/justintadlock/get-the-image
	add_theme_support('get-the-image');

	//add_theme_support( 'cleaner-gallery' );

	// http://themehybrid.com/docs/template-hierarchy
	add_theme_support('hybrid-core-template-hierarchy');

	// Layouts
	add_theme_support('theme-layouts', array('default' => '1-column'));

	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(array(
	  'primary'   => __('Primary', 'abraham'),
	));

  // http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array(
		'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio',
	));

  // Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( abraham_get_editor_styles() );
}

/*
 * Scripts and stylesheets
 */
function abraham_assets() {
	$suffix = hybrid_get_min_suffix();

	// Styles
	wp_enqueue_style(
		'material-icons',
		'//fonts.googleapis.com/icon?family=Material+Icons'
	);

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'hybrid-parent' );

	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );

	// Scripts
	wp_enqueue_script(
		'abraham_js',
		'https://cdn.polyfill.io/v2/polyfill.min.js',
		false, false, true
	);

	// wp_enqueue_script(
	// 	'abraham_js',
	// 	trailingslashit(get_template_directory_uri())."js/abraham{$suffix}.js",
	// 	false, false, true
	// );
	wp_enqueue_style( 'oldie', trailingslashit(get_template_directory_uri()).'css/oldie.css', array( 'hybrid-style' ) );
	wp_style_add_data( 'oldie', 'conditional', 'IE' );

	wp_enqueue_script( 'flexibility', trailingslashit(get_template_directory_uri())."js/flexibility.js",  false, false, false );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );
}

/*
 * Styles for the editor.
 */
function abraham_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'style.css';
	$editor_styles[] = str_replace( ',', '%2C', '//fonts.googleapis.com/icon?family=Material+Icons' );

	/* If a child theme, add its editor styles. */
	if ( is_child_theme() )
	$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'style.css';

	/* Return the styles. */
	return $editor_styles;
}

/**
 * Register sidebars.
 */
if ( ! function_exists( 'abraham_widgets' ) ) {

	function abraham_widgets() {
		register_sidebar(array(
			'id'            => 'primary',
			'name'          => __( 'Primary', 'abraham' ),
			'before_title'  => '<h3 class="h2 widget-title u-mt0">',
			'after_title'   => '</h3>',
			'before_widget' => '<section ' .hybrid_get_attr('widgets', 'primary').'>',
			'after_widget'  => '</section>',
		));

		register_sidebar(array(
			'id'            => 'footer',
			'name'          => __( 'Footer', 'abraham' ),
			'before_title'  => '<h3 class="h2 widget-title u-mt0">',
			'after_title'   => '</h3>',
			'before_widget' => '<section ' .hybrid_get_attr('widgets', 'footer').'>',
			'after_widget'  => '</section>',
		));
	}
}

function abraham_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size(180, 135, true);

	// Create additional sizes.
	add_image_size('abe-hd', 1200, 675, true);
	add_image_size('abe-hd-half', 1200, 338, true);
	add_image_size('abe-card-md', 660, 371, true);
	add_image_size('abe-card', 330, 186, true);
	add_image_size('abe-icon', 60, 60, true);
}

function abraham_layouts() {

	hybrid_register_layout('1-column', array(
		'label'            => _x('Single Column', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column.svg',
	));

	hybrid_register_layout('1-column-wide', array(
		'label'            => _x('Single Column Wide', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column-wide.svg',
	));

	hybrid_register_layout('sidebar-right', array(
		'label'            => _x('Sidebar Right', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-right.svg',
	));

	hybrid_register_layout('sidebar-left', array(
		'label'            => _x('Sidebar Left', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-left.svg',
	));

	// hybrid_register_layout('list', array(
	// 	'label'            => _x('List', 'theme layout', 'abraham'),
	// 	'is_global_layout' => true,
	// 	'image'            => '%s/images/list.svg',
	// ));
}
