<?php
/**
* Clean up wp_head() and add some meta
*
*/

add_action( 'init', 'abe_head_cleanup' );

// https://github.com/roots/soil/blob/master/modules/clean-up.php
function abe_head_cleanup() {
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// hybrid meta
	remove_action( 'wp_head', 'hybrid_meta_charset',   0 );
	remove_action( 'wp_head', 'hybrid_meta_viewport',  1 );
	remove_action( 'wp_head', 'hybrid_meta_generator', 1 );
	remove_action( 'wp_head', 'hybrid_link_pingback',  3 );
	remove_filter( 'wp_title', 'hybrid_wp_title', 0 );
}

/**
* Remove the WordPress version from RSS feeds
*/
add_filter( 'the_generator', '__return_false' );
