<?php
/**
 * Template Filters.
 *
 * @package Abraham
 */

add_filter( 'hybrid_content_template_hierarchy', 'meh_template_hierarchy' );
add_action( 'wp_head','abe_head_meta' );
add_filter( 'excerpt_more', 'meh_excerpt_more' );
add_filter( 'excerpt_length', 'meh_excerpt_length' );

/**
 * Add templates to hybrid_get_content_template()
 */
function meh_template_hierarchy( $templates ) {
	$post_type = get_post_type();
	$post_format = get_post_format() ? get_post_format() : 'standard';

	if ( is_search() ) {
		$templates = array_merge( array( 'content/search.php' ), $templates );
	} elseif ( is_404() ) {
		$templates = array_merge( array( 'content/404.php' ), $templates );
	} elseif ( is_single( get_the_ID() ) ) {
		$templates = array_merge(
			array(
				"content/single-{$post_type}.php",
				"content/single-{$post_format}.php",
				'content/single.php',
			), $templates
		);
	}

	return $templates;
}

function abe_head_meta() {
	$p_color = get_theme_mod( 'primary_color', '' );
	$hex = '#' .$p_color;

	$output = '<meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="msapplication-TileColor" content="' . $hex . '">
	<meta id="theme-color" name="theme-color" content="' . $hex . '">';

	echo $output;
}

/**
 * Clean up the_excerpt().
 */
function meh_excerpt_more() {
	return '<a class="u-abs u-bold u-text-2 u-1of1 btn u-p1 u-px4 u-border0 u-text-right btn-readmore u-z1 u-left0 u-bottom0" href="'.get_permalink().'">Read More</a>';
}

/**
 * Define the_excerpt() character length.
 */
function meh_excerpt_length( $length ) {
	return 40;
}
