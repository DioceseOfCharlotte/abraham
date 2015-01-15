<?php
/**
 * Register menus, sidebars, scripts and styles.
 *
 * @package Abraham
 */

/* Register custom image sizes. */
add_action( 'init', 'abraham_image_sizes', 5 );
/* Add a custom excerpt length. */
add_filter( 'excerpt_length', 'abraham_excerpt_length' );

/* Register custom menus. */
add_action( 'init', 'abraham_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'abraham_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'abraham_styles', 5 );


add_filter( 'hybrid_attr_sidebar', 'abraham_footer_widgets_class', 10, 2 );


function abraham_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size( 175, 130, true );

	// Add the 'abraham-full' image size.
	add_image_size( 'abraham-full', 1025, 500, true );
}

function abraham_excerpt_length( $length ) {
	return 60;
}

function abraham_menus() {
	register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'abraham' ) );
	register_nav_menu( 'social',  _x( 'Social',  'nav menu location', 'abraham' ) );
}

function abraham_sidebars() {
	hybrid_register_sidebar( array(
		'id'          => 'primary',
		'name'        => _x( 'Primary', 'sidebar', 'abraham' ),
		'description' => __( 'The Primary sidebar.', 'abraham' )
	) );

	hybrid_register_sidebar( array(
			'id'          => 'footer-widgets',
			'name'        => _x( 'Footer Widgets', 'sidebar', 'abraham' ),
		'description' => __( 'Typically located in the footer.', 'abraham' )
	) );
}

function abraham_scripts() {

	$suffix = hybrid_get_min_suffix();

	wp_enqueue_script( 'abraham-navigation', trailingslashit( get_template_directory_uri() ) . 'js/navigation.js', array(), null, true );
	wp_enqueue_script( 'abraham-main', trailingslashit( get_template_directory_uri() ) . 'js/main.js', array(), null, true );
}

function abraham_styles() {
	$suffix = hybrid_get_min_suffix();

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'abraham-fonts', '//fonts.googleapis.com/css?family=Roboto:500,400italic,300,700,500italic,300italic,400' );

	if ( is_child_theme() )
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );

	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

/**
 * Filter the hybrid_post_format_link to remove the text
 */
function abraham_post_format_link() {
	echo abraham_get_post_format_link();
}

function abraham_get_post_format_link() {

	$format = get_post_format();
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );

	return sprintf(
	  '<a href="%s" class="post-format-link">
	    <span class="%s format-icon">',
	      esc_url( $url ), get_post_format_string( $format )
	);
}

if ( ! function_exists( 'abraham_format_svg' ) ) :
function abraham_format_svg() {
$format = get_post_format();
get_template_part( 'images/svg/svg', $format );
}
endif; // End check for logo function.





function abraham_footer_widgets_class( $attr, $context ) {
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

function abraham_search_form( $form ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( '&#xf002;', 'submit button' ) .'" />
			</form>';

	return $form;
}

add_filter( 'get_search_form', 'abraham_search_form' );
