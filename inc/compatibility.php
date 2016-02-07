<?php

add_action( 'wp_enqueue_scripts', 'register_ie_scripts' );

/**
 * Load our IE-only stylesheet for old versions of IE:
 */

 // Register Script
function register_ie_scripts() {
	wp_enqueue_script( 'polyfill', 'https://cdn.polyfill.io/v2/polyfill.min.js',  false, false, false );
	wp_script_add_data( 'polyfill', 'conditional', 'IE' );

	wp_enqueue_script( 'flexibility', trailingslashit(get_template_directory_uri())."js/flexibility.js",  false, false, false );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );
}
