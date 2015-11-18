<?php

/**
 * Theme includes.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$abraham_includes = array(
    // 3rd party libraries
    'lib/hybrid-core/hybrid.php',       // Hybrid Core library
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
