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
add_filter( 'get_custom_logo', 'abe_custom_logo' );

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
	return '<a class="btn btn-sm u-p0 u-round u-mx1 u-h3 u-opacity u-lh-1 u-text-2 btn-readmore" href="'.get_permalink().'">'.abe_get_svg( 'ellipsis-circle', 'sm' ).'</a>';
}

/**
 * Define the_excerpt() character length.
 */
function meh_excerpt_length( $length ) {
	return 40;
}

function abe_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo',
        )
    );
	return $html;
}
