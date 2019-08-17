<?php
/**
 * Remove the migrate script from the list of jQuery dependencies.
 *
 * https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
 */

add_action( 'wp_default_scripts', 'abe_dequeue_jquery_migrate' );

function abe_dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;

		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}

function doc_jp_rm_menu() {
	if ( class_exists( 'Jetpack' ) && ! current_user_can( 'manage_options' ) && is_admin() && is_user_logged_in() ) {
		remove_menu_page( 'jetpack' );
	}
}
add_action( 'admin_menu', 'doc_jp_rm_menu', 999 );

function doc_disable_devicepx() {
	wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'doc_disable_devicepx' );

add_action( 'init', 'rcdoc_hybrid_head_cleanup' );

function rcdoc_hybrid_head_cleanup() {
	remove_action( 'wp_head', 'hybrid_meta_charset', 0 );
	remove_action( 'wp_head', 'hybrid_meta_viewport', 1 );
	remove_action( 'wp_head', 'hybrid_meta_generator', 1 );
	remove_action( 'wp_head', 'hybrid_link_pingback', 3 );
	remove_filter( 'wp_title', 'hybrid_wp_title', 0 );
}

add_action( 'init', 'rcdoc_emoji_cleanup' );

function rcdoc_emoji_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
}

