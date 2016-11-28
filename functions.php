<?php
/**
 * Theme includes.
 *
 * @package Abraham
 */

$abe_lib = trailingslashit( get_template_directory() ) . 'lib/';
$abe_inc = trailingslashit( get_template_directory() ) . 'inc/';

// 3rd party libraries.
require_once $abe_lib . 'hybrid-core/hybrid.php'; 	// Hybrid Core library.
require_once $abe_lib . 'cmb2/init.php';          	// Custom Metaboxes.
require_once $abe_lib . 'extended-cpts.php';      	// CPT creation library.
require_once $abe_lib . 'extended-taxos.php';     	// Taxonomy creation library.
require_once $abe_lib . 'tha-theme-hooks.php';    	// Template hooks.

// Theme specific includes.
require_once $abe_inc . 'setup.php';                    	// Initial theme setup.
require_once $abe_inc . 'font-loader.php';                  // Load fonts.
require_once $abe_inc . 'customizer/Color.php';				// Customizer.
require_once $abe_inc . 'customizer/custom-styles.php';		// Customizer.
require_once $abe_inc . 'customizer/customizer.php';    	// Customizer.
require_once $abe_inc . 'customizer/custom-background.php'; // Customizer.
require_once $abe_inc . 'template-tweaks.php';
require_once $abe_inc . 'template-tags.php';
require_once $abe_inc . 'attr-trumps.php';              // Css class selectors.
require_once $abe_inc . 'utils.php';                    // Utility functions.
require_once $abe_inc . 'tiny-mce.php';                 // Extra wysiwyg actions.
require_once $abe_inc . 'head-extra.php';				// head meta.
require_once $abe_inc . 'g-analytics.php';				// Google Analytics.

define( 'HYBRID_DIR', trailingslashit( get_template_directory() ) . 'lib/hybrid-core/' );
define( 'HYBRID_URI', trailingslashit( get_template_directory_uri() ) . 'lib/hybrid-core/' );

new Hybrid();


function get_asset_path( $filename ) {

    // Cache the decoded manifest so that we only read it in once.
    static $manifest = null;
    if ( null === $manifest ) {
        $manifest_path = get_stylesheet_directory() . '/assets/rev-manifest.json';
        $manifest = file_exists( $manifest_path )
            ? json_decode( file_get_contents( $manifest_path ), true )
            : [];
    }

    // If the manifest contains the requested file, return the hashed name.
    if ( array_key_exists( $filename, $manifest ) ) {
        return '/assets/' . $manifest[ $filename ];
    }

    // Assume the file has not been hashed when it was not foun within the
    // manifest.
    return $filename;
}
