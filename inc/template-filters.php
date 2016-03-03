<?php

add_filter('hybrid_content_template_hierarchy', 'meh_template_hierarchy');
add_action('wp_head','abe_head_meta');
add_filter('excerpt_more', 'meh_excerpt_more');
add_filter('excerpt_length', 'meh_excerpt_length');
add_filter('show_admin_bar', '__return_false');

/**
 * Add templates to hybrid_get_content_template()
 */
function meh_template_hierarchy($templates) {
		$post_type = get_post_type();
		$post_format = get_post_format() ? get_post_format() : 'standard';
		// $post_slug = get_the_slug();
	if (is_search()) {
		$templates = array_merge(array('content/search.php'), $templates);
	} elseif (is_404()) {
		$templates = array_merge(array('content/404.php'), $templates);
	} elseif (is_singular()) {
		$templates = array_merge(
		array(
			"content/single-{$post_type}.php",
			"content/single-{$post_format}.php",
			// "content/{$post_type}-{$post_slug}.php"
			"content/single.php",
		), $templates);
	}

	return $templates;
}

function abe_head_meta() {
	$p_color = get_theme_mod('primary_color', '');
	$hex = '#' .$p_color;

	$output ='<meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
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
	return '<a class="u-absolute btn-readmore u-z1 u-right0 u-bottom0" href="'.get_permalink().'"><i class="material-icons">more_horiz</i></a>';
}

/**
 * Define the_excerpt() character length.
 */
function meh_excerpt_length($length) {
	return 40;
}

function abe_excerpt() {
	$abe_excerpt = get_post_meta( get_the_ID(), 'doc_show_content', true );
	if ($abe_excerpt == 'none')
		return;

	return $abe_excerpt == 'content' ? the_content() : the_excerpt();
}
