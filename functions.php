<?php

/**
 * Theme includes.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$abraham_includes = array(
    'inc/hybrid-core/hybrid.php',       // Hybrid Core library
    'inc/attr-trumps.php',              // Css class selectors
    'inc/utils.php',                    // Utility functions
    'inc/init.php',                     // Initial theme setup
    'inc/assets.php',                   // Scripts and styles
    'inc/titles.php',                   // Page titles
    'inc/tiny-mce.php',                 // Extra wysiwyg actions
    'inc/shortcodes.php',               // Shortcodes
    'inc/shortcodes-ui.php',            // Shortcake interface
    'inc/tha-theme-hooks.php',          // Template hooks
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

define('HYBRID_DIR', trailingslashit( get_template_directory()) . 'inc/hybrid-core/');
define('HYBRID_URI', trailingslashit( get_template_directory_uri()) . 'inc/hybrid-core/');

new Hybrid();
