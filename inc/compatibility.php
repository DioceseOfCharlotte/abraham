<?php

add_action( 'wp_enqueue_scripts', 'register_ie_scripts' );


/**
 * Load our IE-only stylesheet for old versions of IE:
 */

 // Register Script
function register_ie_scripts() {
	wp_enqueue_script( 'flexibility', trailingslashit(get_template_directory_uri())."assets/js/flexibility.js",  array(), null, true );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );

	wp_enqueue_script( 'meh-ie-shim', '//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.1.7/es5-shim.min.js',  array(), null, true );
	wp_script_add_data( 'meh-ie-shim', 'conditional', 'IE' );

	wp_enqueue_script( 'meh-ie-classlist', '//cdnjs.cloudflare.com/ajax/libs/classlist/2014.01.31/classList.min.js',  array(), null, true );
	wp_script_add_data( 'meh-ie-classlist', 'conditional', 'IE' );

	wp_enqueue_script( 'meh-ie-selectivizr', '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js',  array(), null, true );
	wp_script_add_data( 'meh-ie-selectivizr', 'conditional', 'IE' );
}
