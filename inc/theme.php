<?php

/* Register custom image sizes. */
add_action( 'init', 'abraham_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'abraham_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_widgets_init', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'abraham_scripts', 5 );

add_filter( 'excerpt_more',   'abraham_excerpt_more'   );

add_filter( 'the_excerpt',    'abraham_the_excerpt', 5 );

add_action('wp_footer', 'doc_drop', 100);

/**
 * Registers custom image sizes for the theme.
 */
function abraham_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	set_post_thumbnail_size( 150, 150, true );

  /* Adds the 'medium-square' image size. */
	add_image_size( 'medium-square', 300, 300, true );
}

/**
 * Registers nav menu locations.
 */
function abraham_register_menus() {
	register_nav_menu( 'primary',    _x( 'Primary',    'nav menu location', 'abraham' ) );
	register_nav_menu( 'secondary',  _x( 'Secondary',  'nav menu location', 'abraham' ) );
	register_nav_menu( 'social', 		 _x( 'Social',     'nav menu location', 'abraham' ) );
}

/**
 * Register widget area.
 */
function abraham_widgets_init() {

	hybrid_register_sidebar( array(
    	'name'          => _x( 'Primary Sidebar', 'sidebar', 'abraham' ),
		'id'            => 'primary',
		'description'   => '',
    	'before_widget' => '<aside id="%1$s" class="primary card layout__item widget %2$s">',
    	'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	hybrid_register_sidebar( array(
		'name'          => _x( 'Secondary Sidebar', 'sidebar', 'abraham' ),
		'id'            => 'secondary',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="secondary card layout__item widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

		hybrid_register_sidebar( array(
    	'name'          => _x( 'Footer Widget Area', 'sidebar', 'abraham' ),
		'id'            => 'footer',
		'description'   => '',
    	'before_widget' => '<aside id="%1$s" class="layout__item widget__footer widget %2$s">',
    	'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/**
 * Enqueue scripts and styles.
 */
function abraham_scripts() {

  $suffix = hybrid_get_min_suffix();

  wp_register_script( 'meh-mainjs', trailingslashit( get_template_directory_uri() ) . "js/main{$suffix}.js", array(), null, true );

  wp_enqueue_script( 'meh-mainjs' );

    wp_register_script( 'meh-classlistjs', trailingslashit( get_template_directory_uri() ) . "js/classList{$suffix}.js", array(), null, true );

  wp_enqueue_script( 'meh-classlistjs' );

    wp_register_script( 'meh-dropjs', trailingslashit( get_template_directory_uri() ) . "js/drop{$suffix}.js", array(), null, true );

  wp_enqueue_script( 'meh-dropjs' );

  /* Register Google-fonts. */
  wp_register_style( 'meh-fonts', '//fonts.googleapis.com/css?family=RobotoDraft:300,400,500|Fira+Sans:300,400,500,700|Lato:300,400,700,900' );

  /* Register Font Awesome. */
  wp_register_style( 'meh-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
}

/**
 * Set read-more links text and link it to the post.
 */
function abraham_excerpt_more( $more ) {
	return ' &hellip; ';
}

function abraham_the_excerpt( $excerpt ) {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Continue reading %s', 'saga' ), '<span class="screen-reader-text visuallyhidden">' . get_the_title() . '</span>' );
	$more = sprintf( '<p class="more-link-wrap"><a href="%s" class="more-link">%s</a></p>', get_permalink(), $text );

	return $excerpt . $more;
}

/**
 * We need to add attributes for the different sidebars.
 */
add_filter( 'hybrid_attr_sidebar_1', 'meh_attr_sidebar_1' );

function meh_attr_sidebar_1( $attr ) {

  	$attr['class']     = 'sidebar';
  	$attr['role']      = 'complementary';
  	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/WPSideBar';

  return $attr;
}

add_filter( 'hybrid_attr_sidebar_2', 'meh_attr_sidebar_2' );

function meh_attr_sidebar_2( $attr ) {

  	$attr['class']     = 'sidebar';
  	$attr['role']      = 'complementary';
  	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/WPSideBar';

  return $attr;
}


/**
 * initialize the drop js
 */
function doc_drop(){
?>
    <script type='text/javascript'>
    	drop.init();
   </script>
<?php
}

/**
 * Hooks
 */
function doc_header_before() {
	do_action( 'doc_header_before' );
}

function doc_header_after() {
	do_action( 'doc_header_after' );
}

function doc_content_top() {
	do_action( 'doc_content_top' );
}

function doc_content_bottom() {
	do_action( 'doc_content_bottom' );
}