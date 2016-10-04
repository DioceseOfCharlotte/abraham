<?php
/**
 * Template Filters.
 *
 * @package Abraham
 */

add_filter( 'hybrid_content_template_hierarchy', 'abe_template_hierarchy' );
add_filter( 'excerpt_more', 'abe_excerpt_more' );
add_filter( 'excerpt_length', 'abe_excerpt_length' );
add_filter( 'get_custom_logo', 'abe_custom_logo' );
add_filter( 'edit_post_link', 'abe_edit_post_link' );

/**
 * Add templates to hybrid_get_content_template()
 */
function abe_template_hierarchy( $templates ) {
	$post_type = get_post_type();
	$post_format = get_post_format() ? get_post_format() : 'standard';

	if ( is_search() ) {
		$templates = array_merge( array( 'content/search.php' ), $templates );
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

/**
 * Clean up the_excerpt().
 */
function abe_excerpt_more() {
	return '<a class="btn btn-sm u-p0 u-round u-mx1 u-h3 u-opacity u-lh-1 u-text-2 btn-readmore" href="' . get_permalink() . '">' . abe_get_svg( 'ellipsis-circle', 'sm' ) . '</a>';
}

/**
 * Define the_excerpt() character length.
 */
function abe_excerpt_length( $length ) {
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

/**
 * Customize the html of the edit link
 *
 * @param string $output Link html.
 */
function abe_edit_post_link( $output ) {
	$output = str_replace( 'class="post-edit-link"', 'class="post-edit-link btn btn-round u-opacity u-abs u-right0 u-bottom0"', $output );
	return $output;
}
