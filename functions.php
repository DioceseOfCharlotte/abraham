<?php

/**
 * Theme includes.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$abraham_includes = array(
    // 3rd party libraries
    'lib/hybrid-core/hybrid.php',       // Hybrid Core library
    'lib/meh-shorts/shortcodes.php',    // Shortcodes
    'lib/meh-shorts/shorts-ui.php',     // Shortcake interface
    'lib/tha-theme-hooks.php',          // Template hooks
    // Theme specific includes
    'inc/setup.php',                     // Initial theme setup
    'inc/attr-trumps.php',              // Css class selectors
    'inc/utils.php',                    // Utility functions
    'inc/tiny-mce.php',                 // Extra wysiwyg actions
    'inc/compatibility.php',            // 3rd party compatibilty
    'inc/customizer/customizer.php',    // Customizer
);

foreach ($abraham_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__(
        'Error locating %s', 'abraham'
        ), $file), E_USER_ERROR);
    }
    require_once $filepath;
}
unset($file, $filepath);

define('HYBRID_DIR', trailingslashit( get_template_directory()) . 'lib/hybrid-core/');
define('HYBRID_URI', trailingslashit( get_template_directory_uri()) . 'lib/hybrid-core/');

new Hybrid();




/*
 * Scripts and stylesheets
 */
add_action('wp_enqueue_scripts', 'abraham_assets');

function abraham_assets() {
    $suffix = hybrid_get_min_suffix();

    // Styles
    wp_enqueue_style(
        'material-icons',
        '//fonts.googleapis.com/icon?family=Material+Icons'
    );

    // Load parent theme stylesheet if child theme is active.
    if ( is_child_theme() )
    	wp_enqueue_style( 'hybrid-parent' );

    // Load active theme stylesheet.
    wp_enqueue_style( 'hybrid-style' );

    // Scripts
    wp_enqueue_script(
        'abraham_js',
        trailingslashit(get_template_directory_uri())."assets/js/main{$suffix}.js",
        false, false, true
    );
}
