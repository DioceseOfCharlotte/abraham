<?php
/**
* Clean up wp_head() and add some meta
*
*/

// https://github.com/roots/soil/blob/master/modules/clean-up.php
function abe_head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	add_action( 'wp_head', 'ob_start', 1, 0 );
	add_action('wp_head', function () {
		$pattern = '/.*' . preg_quote( esc_url( get_feed_link( 'comments_' . get_default_feed() ) ), '/' ) . '.*[\r\n]+/';
		echo preg_replace( $pattern, '', ob_get_clean() );
	}, 3, 0);
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'use_default_gallery_style', '__return_false' );
	global $wp_widget_factory;
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', [ $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ] );
	}

	// hybrid meta
	remove_action( 'wp_head', 'hybrid_meta_charset',   0 );
	remove_action( 'wp_head', 'hybrid_meta_viewport',  1 );
	remove_action( 'wp_head', 'hybrid_meta_generator', 1 );
	remove_action( 'wp_head', 'hybrid_link_pingback',  3 );
	remove_filter( 'wp_title', 'hybrid_wp_title', 0 );
}

add_action( 'init', 'abe_head_cleanup' );
// add_filter( 'style_loader_tag', 'abe_clean_style_tag' );
// add_filter( 'script_loader_tag', 'abe_clean_script_tag' );
add_action( 'admin_init', 'abe_remove_dashboard_widgets' );

/**
* Remove the WordPress version from RSS feeds
*/
add_filter( 'the_generator', '__return_false' );

/**
* Clean up output of stylesheet <link> tags
*/
function abe_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	if ( empty( $matches[2] ) ) {
		return $input;
	}
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
* Clean up output of <script> tags
*/
function abe_clean_script_tag( $input ) {
	$input = str_replace( "type='text/javascript' ", '', $input );
	return str_replace( "'", '"', $input );
}

/**
* Remove unnecessary dashboard widgets
*
* @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
*/
function abe_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
}
