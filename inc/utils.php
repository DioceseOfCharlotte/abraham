<?php
use Mexitek\PHPColors\Color;

add_filter('hybrid_content_template_hierarchy', 'meh_template_hierarchy');
add_filter('excerpt_more', 'meh_excerpt_more');
add_filter('excerpt_length', 'meh_excerpt_length');
add_action('after_setup_theme', 'meh_responsive_videos', 99);
//add_filter( 'page_css_class', 'meh_doc_page_css_class', 10, 2 );
add_shortcode( 'doc_logout', 'doc_logout_link' );
add_shortcode( 'doc_pass_reset', 'doc_pass_reset_link' );

function abe_hierarchy_cpts($cpts = array()) {
	$cpts = array( 'page' );

	if(has_filter('abe_add_hierarchy_cpts')) {
		$cpts = apply_filters('abe_add_hierarchy_cpts', $cpts);
	}

	return $cpts;
}

function abe_non_hierarchy_cpts($cpts = array()) {
	$cpts = array( 'post' );

	if (has_filter('abe_add_non_hierarchy_cpts')) {
		$cpts = apply_filters('abe_add_non_hierarchy_cpts', $cpts);
	}

	return $cpts;
}

/**
 * Add templates to hybrid_get_content_template()
 */
function meh_template_hierarchy($templates) {
		$post_type = get_post_type();
		$post_slug = get_the_slug();
	if (is_search()) {
		$templates = array_merge(array('content/search.php'), $templates);
	} elseif (is_404()) {
		$templates = array_merge(array('content/404.php'), $templates);
	} elseif (is_singular()) {
		$templates = array_merge(array("content/{$post_type}-single.php"), $templates);
		$templates = array_merge(array("content/single.php"), $templates);
		//$templates = array_merge(array("content/{$post_type}-{$post_slug}.php"), $templates);
	}

	return $templates;
}

/**
 * Clean up the_excerpt().
 */
function meh_excerpt_more() {
	return '<a class="u-absolute btn-readmore u-z1 u-right0 u-bottom0" href="'.get_permalink().'"><i class="material-icons">more_horiz</i></a>';
}

function meh_excerpt_length($length) {
	return 40;
}

function meh_responsive_videos() {

	/* Wrap the videos */
	add_filter('wp_video_shortcode', 'meh_responsive_videos_embed_html');
	add_filter('video_embed_html', 'meh_responsive_videos_embed_html');

	/* Only wrap oEmbeds if video */
	add_filter('embed_oembed_html', 'meh_responsive_videos_embed_html');
	add_filter('embed_handler_html', 'meh_responsive_videos_embed_html');
}

/**
 * Adds a wrapper to videos and enqueue script.
 *
 * @return string
 */
function meh_responsive_videos_embed_html($html) {
	if (empty($html) || !is_string($html)) {
		return $html;
	}

	return '<div class="FlexEmbed"><div class="FlexEmbed-ratio FlexEmbed-ratio--16by9"></div><div class="FlexEmbed-content">'.$html.'</div></div>';
}

function doc_page_css_class($css_class, $page) {

	if ( ! members_can_current_user_view_post( $page->ID ) )
		$css_class[] = 'is-protected muted';

	return $css_class;
}

function get_the_slug($id=null) {
	if( empty($id) ):
		global $post;
	if( empty($post) )
		return ''; // No global $post var available.
		$id = $post->ID;
	endif;

	$slug = basename( get_permalink($id) );
	return $slug;
}

// Shortcode
function doc_logout_link() {
$logoutlink = wp_logout_url( home_url() );
return '<a href="' . $logoutlink . '">Logout</a>';
}

// Shortcode
function doc_pass_reset_link() {
$passresetlink = wp_lostpassword_url( get_permalink() );
return '<a href="' . $passresetlink . '" title="Lost Password">Lost Password</a>';
}

function doc_hex_prime($doc_hex) {
$doc_hex = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
$primaryText = new Color($doc_hex);
$textColor = $primaryText->isDark() ? "#ECEFF1" : "#36474f";

return $textColor;
}

function doc_rgb_prime($alpha) {
$doc_hex = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
$doc_rgb = implode( ',', hybrid_hex_to_rgb( $doc_hex ) );

return 'rgba('. $doc_rgb .','. $alpha .')';
}
