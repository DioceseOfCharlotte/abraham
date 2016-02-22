<?php
/**
 * Theme includes.
 */

$abe_lib = trailingslashit( get_template_directory() ) . 'lib/';
$abe_inc = trailingslashit( get_template_directory() ) . 'inc/';

// 3rd party libraries
require_once $abe_lib . 'hybrid-core/hybrid.php'; 	// Hybrid Core library
require_once $abe_lib . 'cmb2/init.php';          	// Custom Metaboxes
require_once $abe_lib . 'extended-cpts.php';      	// CPT creation library
require_once $abe_lib . 'extended-taxos.php';     	// Taxonomy creation library
require_once $abe_lib . 'tha-theme-hooks.php';    	// Template hooks

// Theme specific includes
require_once $abe_inc . 'setup.php';                    // Initial theme setup
require_once $abe_inc . 'customizer/Color.php';
require_once $abe_inc . 'customizer/fonts.php';
require_once $abe_inc . 'customizer/custom-styles.php';
require_once $abe_inc . 'customizer/customizer.php';    // Customizer
require_once $abe_inc . 'customizer/custom-background.php';    // Customizer
require_once $abe_inc . 'template-filters.php';
require_once $abe_inc . 'views-template-tags.php';
require_once $abe_inc . 'archive-width.php';
require_once $abe_inc . 'metaboxes.php';
require_once $abe_inc . 'attr-trumps.php';              // Css class selectors
require_once $abe_inc . 'utils.php';                    // Utility functions
require_once $abe_inc . 'tiny-mce.php';                 // Extra wysiwyg actions
require_once $abe_inc . 'compatibility.php';            // 3rd party compatibilty

define('HYBRID_DIR', trailingslashit( get_template_directory() ) . 'lib/hybrid-core/');
define('HYBRID_URI', trailingslashit( get_template_directory_uri() ) . 'lib/hybrid-core/');

new Hybrid();
