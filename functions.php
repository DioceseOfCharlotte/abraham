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
    'inc/attr-trumps.php',              // Css class selectors
    'inc/utils.php',                    // Utility functions
    'inc/init.php',                     // Initial theme setup
    'inc/tiny-mce.php',                 // Extra wysiwyg actions
    'inc/template-actions.php',         // Action hooks
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

    if (is_child_theme()) {
        wp_enqueue_style(
            'parent',
            trailingslashit(get_template_directory_uri())."style{$suffix}.css"
        );
    }
        wp_enqueue_style(
            'style',
            get_stylesheet_uri()
        );

    // Scripts
    wp_enqueue_script(
        'material_js',
        '//storage.googleapis.com/code.getmdl.io/1.0.4/material.min.js',
        false, false, true
    );

    wp_enqueue_script(
        'abraham_js',
        trailingslashit(get_template_directory_uri())."assets/js/main{$suffix}.js",
        false, false, true
    );
}
