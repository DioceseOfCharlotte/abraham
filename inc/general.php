<?php
/**
 * Register menus, sidebars, scripts and styles.
 *
 * @package Scratch
 */

/* Register custom image sizes. */
add_action( 'init', 'scratch_image_sizes', 5 );
/* Add a custom excerpt length. */
add_filter( 'excerpt_length', 'scratch_excerpt_length' );

/* Register custom menus. */
add_action( 'init', 'scratch_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'scratch_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'scratch_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'scratch_styles', 5 );


add_filter( 'hybrid_attr_sidebar', 'scratch_footer_widgets_class', 10, 2 );


function scratch_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size( 175, 130, true );

	// Add the 'scratch-full' image size.
	add_image_size( 'scratch-full', 1025, 500, true );
}

function scratch_excerpt_length( $length ) {
	return 60;
}

function scratch_menus() {
	register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'scratch' ) );
	register_nav_menu( 'social',  _x( 'Social',  'nav menu location', 'scratch' ) );
}

function scratch_sidebars() {
	hybrid_register_sidebar( array(
		'id'          => 'primary',
		'name'        => _x( 'Primary', 'sidebar', 'scratch' ),
		'description' => __( 'The Primary sidebar.', 'scratch' )
	) );

	hybrid_register_sidebar( array(
			'id'          => 'footer-widgets',
			'name'        => _x( 'Footer Widgets', 'sidebar', 'scratch' ),
		'description' => __( 'Typically located in the footer.', 'scratch' )
	) );
}

function scratch_scripts() {

	$suffix = hybrid_get_min_suffix();

	wp_enqueue_script( 'scratch-navigation', trailingslashit( get_template_directory_uri() ) . 'js/navigation.js', array(), null, true );
	wp_enqueue_script( 'scratch-main', trailingslashit( get_template_directory_uri() ) . 'js/main.js', array(), null, true );
}

function scratch_styles() {
	$suffix = hybrid_get_min_suffix();

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'scratch-fonts', '//fonts.googleapis.com/css?family=RobotoDraft:regular,bold,italic,thin,light,bolditalic,black,medium' );

	if ( is_child_theme() )
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );

	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

/**
 * Filter the hybrid_post_format_link to remove the text
 */
function scratch_post_format_link() {
	echo scratch_get_post_format_link();
}

function scratch_get_post_format_link() {

	$format = get_post_format();
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );

	return sprintf(
	  '<a href="%s" class="post-format-link">
	    <span class="%s format-icon">',
	      esc_url( $url ), get_post_format_string( $format )
	);
}

if ( ! function_exists( 'scratch_format_svg' ) ) :
function scratch_format_svg() {
$format = get_post_format();
get_template_part( 'images/svg/svg', $format );
}
endif; // End check for logo function.





function scratch_footer_widgets_class( $attr, $context ) {
	if ( 'footer-widgets' === $context ) {
		global $sidebars_widgets;
		if ( is_array( $sidebars_widgets ) && !empty( $sidebars_widgets[ $context ] ) ) {
			$count = count( $sidebars_widgets[ $context ] );
			if ( 1 === $count )
				$attr['class'] .= ' sidebar-col-1';
			elseif ( !( $count % 3 ) || $count % 2 )
				$attr['class'] .= ' sidebar-col-3';
			elseif ( !( $count % 2 ) )
				$attr['class'] .= ' sidebar-col-2';
		}
	}
	return $attr;
}
