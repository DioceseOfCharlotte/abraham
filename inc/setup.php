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
add_action( 'wp_head', 'abe_font_loader' );


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

	add_theme_support( 'customize-selective-refresh-widgets' );

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
		'height'      => 78,
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
	$GLOBALS['content_width'] = apply_filters( 'abe_content_width', 1184 );
}

/**
 * Register Google font.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function abe_font_url() {
	$fonts_url = '';
	$roboto = _x( 'on', 'Roboto font: on or off', 'abe' );
	$cormorant = _x( 'on', 'Cormorant font: on or off', 'abe' );

	if ( 'off' !== $roboto || 'off' !== $cormorant ) {
		$font_families = array();
		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:400,500,700';
		}
		if ( 'off' !== $cormorant ) {
			$font_families[] = 'Cormorant Garamond:400,500,600';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Scripts and stylesheets
 */
function abraham_assets() {
	$suffix = hybrid_get_min_suffix();

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'hybrid-parent' );

	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );

	// Google fonts
	// wp_register_style( 'abe-google-font', abe_font_url(), array(), null );
	// wp_enqueue_style( 'abe-google-font' );

	wp_enqueue_style( 'oldie', trailingslashit( get_template_directory_uri() )."css/oldie{$suffix}.css", array( 'hybrid-style' ) );
	wp_style_add_data( 'oldie', 'conditional', 'lt IE 9' );

	// Scripts.
	wp_enqueue_script( 'abraham_js', trailingslashit( get_template_directory_uri() )."js/abraham{$suffix}.js", false, false, true );

	// wp_enqueue_script( 'webfont', 'https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.24/webfontloader.js', array( 'abraham_js' ), false, true );

	// polyfills
	wp_enqueue_script( 'object_fit_js', trailingslashit( get_template_directory_uri() )."js/polyfill/ofi.browser.js", false, false, true );

	wp_enqueue_script( 'html5shiv', trailingslashit( get_template_directory_uri() ).'js/polyfill/html5shiv.min.js',  false, false, false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'classlist', trailingslashit( get_template_directory_uri() ).'js/polyfill/classList.min.js',  false, false, false );
	wp_script_add_data( 'classlist', 'conditional', 'IE' );

	wp_enqueue_script( 'flexibility', trailingslashit( get_template_directory_uri() ).'js/polyfill/flexibility.js',  false, false, false );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );
}

function abe_font_loader() { ?>
	<script type="text/javascript">
		WebFontConfig = {
		  google: {
		    families: ['Cormorant Garamond:400,500,600']
		  }
		};

		(function(d) {
	       var wf = d.createElement('script'), s = d.scripts[0];
	       wf.src = 'https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.24/webfontloader.js';
		   wf.type = 'text/javascript';
		   wf.async = 'true';
	       s.parentNode.insertBefore(wf, s);
	    })(document);
	</script>
	<style type="text/css">
	.wf-active .u-text-display {
		font-family: 'Cormorant Garamond', serif;
		font-weight: 600;
	}
	</style>
<?php }

/**
 * Styles for the editor.
 */
function abraham_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'style.css';

	/* If a child theme, add its editor styles. */
	if ( is_child_theme() ) {
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'style.css'; }

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
	register_sidebar(
		array(
			'id'          	=> 'primary',
			'name'        	=> esc_html__( 'Primary', 'sidebar', 'abraham' ),
			'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
			'before_widget' => '<section id="%1$s" class="widget u-p2 u-mb3 u-bg-frost-1 u-br %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'          	=> 'secondary',
			'name'        	=> esc_html__( 'Secondary', 'sidebar', 'abraham' ),
			'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
			'before_widget' => '<section id="%1$s" class="widget u-p2 u-mb3 u-bg-frost-1 u-br %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'id'          	=> 'footer',
			'name'        	=> esc_html__( 'Footer', 'sidebar', 'abraham' ),
			'description'   => esc_html__( 'Add widgets here.', 'abraham' ),
			'before_widget' => '<section id="%1$s" class="widget u-p2 u-mb3 u-bg-tint-1 u-br %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
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
