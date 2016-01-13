<?php

/**
 * Theme includes.
 */

 /* Get the template directory and make sure it has a trailing slash. */
$abraham_dir = trailingslashit( get_template_directory() );

// 3rd party libraries
require_once( $abraham_dir . '/lib/hybrid-core/hybrid.php');       // Hybrid Core library
require_once( $abraham_dir . '/lib/tha-theme-hooks.php');          // Template hooks
require_once( $abraham_dir . '/lib/cmb2/init.php');                // Custom Metaboxes
// Theme specific includes
require_once( $abraham_dir . '/inc/setup.php');                    // Initial theme setup
require_once( $abraham_dir . '/inc/archive-width.php');
require_once( $abraham_dir . '/inc/attr-trumps.php');              // Css class selectors
require_once( $abraham_dir . '/inc/utils.php');                    // Utility functions
require_once( $abraham_dir . '/inc/tiny-mce.php');                 // Extra wysiwyg actions
require_once( $abraham_dir . '/inc/compatibility.php');            // 3rd party compatibilty
require_once( $abraham_dir . '/inc/customizer/customizer.php');    // Customizer

define('HYBRID_DIR', trailingslashit( get_template_directory()) . 'lib/hybrid-core/');
define('HYBRID_URI', trailingslashit( get_template_directory_uri()) . 'lib/hybrid-core/');

new Hybrid();





add_filter( 'map_meta_cap', 'my_map_meta_cap', 16, 4 );

function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

    if ( 'read_post' === $cap ) {
        $post = get_post( $args[0] );

        if ( 'document' === $post->post_type && 'private' === $post->post_status && members_can_user_view_post( $user_id, $post->ID ) ) {
            $caps = array();
        }
    }

    return $caps;
}
