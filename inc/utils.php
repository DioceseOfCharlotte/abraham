<?php

add_action('after_setup_theme', 'meh_responsive_videos', 99);
//add_filter( 'page_css_class', 'meh_doc_page_css_class', 10, 2 );
add_shortcode( 'doc_logout', 'doc_logout_link' );
add_shortcode( 'doc_pass_reset', 'doc_pass_reset_link' );
add_shortcode('abe_permalink', 'abe_do_permalink');

function abe_hierarchy_cpts() {
	$cpts = array( 'page' );

	if(has_filter('abe_add_hierarchy_cpts')) {
		$cpts = apply_filters('abe_add_hierarchy_cpts', $cpts);
	}

	return $cpts;
}

function abe_non_hierarchy_cpts() {
	$cpts = array( 'post' );

	if (has_filter('abe_add_non_hierarchy_cpts')) {
		$cpts = apply_filters('abe_add_non_hierarchy_cpts', $cpts);
	}

	return $cpts;
}


function meh_responsive_videos() {

	/* Wrap the videos */
	add_filter('wp_video_shortcode', 'meh_responsive_videos_embed_html');
	add_filter('video_embed_html', 'meh_responsive_videos_embed_html');

	/* Only wrap oEmbeds if video */
	add_filter('embed_oembed_html', 'meh_responsive_videos_maybe_wrap_oembed', 10, 2 );
	add_filter('embed_handler_html', 'meh_responsive_videos_maybe_wrap_oembed', 10, 2 );
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

/**
 * Check if oEmbed is a `$video_patterns` provider video before wrapping.
 *
 * @return string
 */
function meh_responsive_videos_maybe_wrap_oembed($html, $url = null) {
	if ( empty( $html ) || ! is_string( $html ) || ! $url ) {
		return $html;
	}
	$meh_video_wrapper = '<div class="FlexEmbed">';
	$already_wrapped   = strpos( $html, $meh_video_wrapper );
	// If the oEmbed has already been wrapped, return the html.
	if ( false !== $already_wrapped ) {
		return $html;
	}
	/**
	 * oEmbed Video Providers.
	 *
	 * A whitelist of oEmbed video provider Regex patterns to check against before wrapping the output.
	 *
	 * @module theme-tools
	 *
	 * @since 3.8.0
	 *
	 * @param array $video_patterns oEmbed video provider Regex patterns.
	 */
	$video_patterns = apply_filters( 'meh_responsive_videos_oembed_videos', array(
		'https?://((m|www)\.)?youtube\.com/watch',
		'https?://((m|www)\.)?youtube\.com/playlist',
		'https?://youtu\.be/',
		'https?://(.+\.)?vimeo\.com/',
		'https?://(www\.)?dailymotion\.com/',
		'https?://dai.ly/',
		'https?://(www\.)?hulu\.com/watch/',
		'https?://wordpress.tv/',
		'https?://(www\.)?funnyordie\.com/videos/',
		'https?://vine.co/v/',
		'https?://(www\.)?collegehumor\.com/video/',
		'https?://(www\.|embed\.)?ted\.com/talks/',
	) );
	// Merge patterns to run in a single preg_match call.
	$video_patterns = '(' . implode( '|', $video_patterns ) . ')';
	$is_video       = preg_match( $video_patterns, $url );
	// If the oEmbed is a video, wrap it in the responsive wrapper.
	if ( false === $already_wrapped && 1 === $is_video ) {
		return meh_responsive_videos_embed_html( $html );
	}
	return $html;
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
return '<a class="btn btn-small u-br u-mt2" href="' . $logoutlink . '">Logout</a>';
}

// Shortcode
function doc_pass_reset_link() {
$passresetlink = wp_lostpassword_url( get_permalink() );
return '<a class="u-f-minus u-link u-bottom0 u-right0 u-abs" href="' . $passresetlink . '" title="Lost Password">Lost your password?</a>';
}

// Permalink
function abe_do_permalink($atts) {
	extract(shortcode_atts(array(
		'id'   => get_the_ID(),
		'text' => "",  // default value if none supplied
    ), $atts));

    if ($text) {
        $url = get_permalink($id);
        return "<a href='$url'>$text</a>";
    } else {
	   return get_permalink($id);
	}
}

function abe_excerpt() {
	return arch_excerpt();
}
