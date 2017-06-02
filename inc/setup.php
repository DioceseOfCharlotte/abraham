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
add_filter( 'show_admin_bar' , 'abe_show_admin_bar' );


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

	add_theme_support( 'theme-layouts', array(
		'default' => '1-column',
	) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-logo', array(
		'height'      => 78,
		'flex-width' => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary', 'abraham' ),
	) );

	// Tell the TinyMCE editor to use a custom stylesheet.
	add_editor_style( abraham_get_editor_styles() );
}

/**
 * Append Hash to assets filename to purge the browser cache when changed.
 */
function get_asset_rev( $filename ) {

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return $filename;
	}

	// Cache the decoded manifest so that we only read it in once.
	static $manifest = null;
	if ( null === $manifest ) {
		$manifest_path = get_parent_theme_file_path( 'rev-manifest.json' );
		$manifest = file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
	}

	// If the manifest contains the requested file, return the hashed name.
	if ( array_key_exists( $filename, $manifest ) ) {
		return $manifest[ $filename ];
	}

	// File hash wasn't found.
	return $filename;
}

/**
 * Append Hash to assets filename to purge the browser cache when changed.
 */
function get_child_asset_rev( $filename ) {

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return $filename;
	}

	// Cache the decoded manifest so that we only read it in once.
	static $manifest = null;
	if ( null === $manifest ) {
		$manifest_path = get_theme_file_path( 'rev-manifest.json' );
		$manifest = file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
	}

	// If the manifest contains the requested file, return the hashed name.
	if ( array_key_exists( $filename, $manifest ) ) {
		return $manifest[ $filename ];
	}

	// File hash wasn't found.
	return $filename;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function abraham_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'abe_content_width', 1184 );
}

/**
 * Scripts and stylesheets
 */
function abraham_assets() {
	$suffix = hybrid_get_min_suffix();

	wp_enqueue_style( 'abe-style', get_parent_theme_file_uri( get_asset_rev( 'style.css' ) ) );

	if ( is_child_theme() ) {
		wp_enqueue_style( 'abe-child-style', get_theme_file_uri( get_child_asset_rev( 'style.css' ) ) );
	}

	wp_enqueue_style( 'oldie', get_theme_file_uri( "css/oldie{$suffix}.css" ), array( 'abe-style' ) );
	wp_style_add_data( 'oldie', 'conditional', 'IE' );

	// Scripts.
	wp_enqueue_script( 'abraham-js', get_parent_theme_file_uri( 'js/' . get_asset_rev( 'abraham.js' ) ), false, false, true );

	// polyfills
	wp_enqueue_script( 'polyfill-io', 'https://cdn.polyfill.io/v2/polyfill.min.js', false, false, false );

	wp_enqueue_script( 'object-fit-js', get_theme_file_uri( 'js/polyfill/ofi.browser.js' ), false, false, true );
	wp_add_inline_script( 'object-fit-js', 'objectFitImages();' );

	wp_enqueue_script( 'html5shiv', get_theme_file_uri( 'js/polyfill/html5shiv.min.js' ),  false, false, false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
}

/**
 * Admin styles and fixes.
 */
function abe_admin_styles() {
	wp_enqueue_style( 'abe-admin-fixes', get_theme_file_uri( 'css/abe-admin.css' ), false, false );
}
add_action( 'admin_enqueue_scripts', 'abe_admin_styles' );

/**
 * Styles for the editor.
 */
function abraham_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* If child theme, add its parent editor styles. */
	if ( is_child_theme() ) {
		$editor_styles[] = get_parent_theme_file_uri( 'style.css' );
	}

	/* Add the theme's editor styles. */
	$editor_styles[] = get_theme_file_uri( 'style.css' );

		/* Return the styles. */
		return $editor_styles;
}

/**
 * Registers sidebars.
 *
 * @access public
 * @return void
 */
function abraham_widgets() {
	register_sidebar( array(
		'id'            => 'primary',
		'name'          => esc_html__( 'Primary', 'abraham' ),
		'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
		'before_widget' => '<section id="%1$s" class="widget u-mb u-bg-frost-1 u-br %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title u-h3 u-text-display u-pt0 u-opacity">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'id'            => 'secondary',
		'name'          => esc_html__( 'Secondary', 'abraham' ),
		'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
		'before_widget' => '<section id="%1$s" class="widget u-mb u-bg-frost-1 u-br %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title u-h3 u-px1 u-text-display u-pt0 u-opacity u-text-center">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'id'            => 'footer',
		'name'          => esc_html__( 'Footer', 'abraham' ),
		'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
		'before_widget' => '<section id="%1$s" class="widget u-p1 u-mb u-bg-frost-1 u-br %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title u-h3 u-text-display u-pt0 u-opacity">',
		'after_title'   => '</h2>',
	) );
}

/**
 * Create additional sizes.
 */
function abraham_image_sizes() {
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'abe-icon',     80, 80, true );
	add_image_size( 'abe-hd',       640, 360, true );
	add_image_size( 'abe-hd-lg',    1200, 675, true );
	add_image_size( 'abe-card',     380, 506, true );
	add_image_size( 'abe-card-lg',  760, 1012, true );
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

	hybrid_register_layout('blank-canvas', array(
		'label'            => _x( 'Blank Canvas', 'theme layout', 'abraham' ),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column-clear.svg',
	));
}
