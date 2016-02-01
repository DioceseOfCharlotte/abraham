<?php
/*
 * Theme setup
 */

add_action('after_setup_theme', 'abraham_setup', 5);
add_action('wp_head','abe_head_meta');
add_action('wp_enqueue_scripts', 'abraham_assets');
add_action('init', 'abraham_image_sizes', 5);
add_action('hybrid_register_layouts', 'abraham_layouts');
add_filter('show_admin_bar', '__return_false');

function abraham_setup() {

	// http://codex.wordpress.org/Automatic_Feed_Links
	add_theme_support('automatic-feed-links');

	// https://github.com/justintadlock/breadcrumb-trail
	add_theme_support('breadcrumb-trail');

	// https://github.com/justintadlock/get-the-image
	add_theme_support('get-the-image');

	// http://themehybrid.com/docs/template-hierarchy
	add_theme_support('hybrid-core-template-hierarchy');

	// Layouts
	add_theme_support('theme-layouts', array('default' => '1-column'));

	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(array(
	  'primary'   => __('Primary', 'abraham'),
	  'logged-in' => __('Logged In', 'abraham'),
	));

  // http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array(
		'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio',
	));

  // Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( abraham_get_editor_styles() );
}



function abe_head_meta() {
	$p_color = get_theme_mod('primary_color', '');
	$hex = '#' .$p_color;

	$output ='<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="msapplication-TileColor" content="' . $hex . '">
<meta name="theme-color" content="' . $hex . '">';

	echo $output;
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
		trailingslashit(get_template_directory_uri())."assets/js/abraham{$suffix}.js",
		false, false, true
	);
}

/*
 * Styles for the editor.
 */
function abraham_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'style.css';

	/* If a child theme, add its editor styles. */
	if ( is_child_theme() )
	$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'style.css';

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'abraham_editor_styles', admin_url( 'admin-ajax.php' ) );

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
add_action('widgets_init', 'abraham_widgets', 5);

}

function abraham_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size(150, 150, true);
	// Add the 'abraham-full' image size.
	add_image_size('abraham-retina', 2560, 720, true);
	add_image_size('abraham-md', 1024, 288, true);
	add_image_size('abraham-full-cropped', 1280, 720, true);
	add_image_size('abraham-full', 1920, 740, true);
	add_image_size('abraham-hd', 1920, 1080, true);
	add_image_size('abraham-sm', 640, 360, true);
}

function abraham_layouts() {

	hybrid_register_layout('1-column', array(
		'label'            => _x('Single Column', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/assets/images/single-column.svg',
	));

	hybrid_register_layout('1-column-wide', array(
		'label'            => _x('Single Column Wide', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/assets/images/single-column-wide.svg',
	));

	hybrid_register_layout('sidebar-right', array(
		'label'            => _x('Sidebar Right', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/assets/images/sidebar-right.svg',
	));

	hybrid_register_layout('sidebar-left', array(
		'label'            => _x('Sidebar Left', 'theme layout', 'abraham'),
		'is_global_layout' => true,
		'image'            => '%s/assets/images/sidebar-left.svg',
	));

	hybrid_register_layout('list', array(
		'label'            => _x('List', 'theme layout', 'abraham'),
		'is_global_layout' => false,
		'post_types'       => array('gravityview'),
		'image'            => '%s/assets/images/list.svg',
	));

	hybrid_register_layout('2-card-row', array(
		'label'            => _x('2-card-row', 'theme layout', 'abraham'),
		'is_global_layout' => false,
		'post_types'       => array('gravityview'),
		'image'            => '%s/assets/images/2-card-row.svg',
	));

	hybrid_register_layout('3-card-row', array(
		'label'            => _x('2-card-row', 'theme layout', 'abraham'),
		'is_global_layout' => false,
		'post_types'       => array('gravityview'),
		'image'            => '%s/assets/images/3-card-row.svg',
	));
}
