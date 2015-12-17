<?php

add_action( 'wp_head',  'enqueue_abraham_ie' );



    add_post_type_support('gravityview', 'theme-layouts');
    add_post_type_support('sc_event', 'theme-layouts');
    add_post_type_support('cpt_archive', 'theme-layouts');


/**
 * Load our IE-only stylesheet for old versions of IE:
 */
function enqueue_abraham_ie() {

     echo '<!--[if IE]>';
     echo '<script src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.1.7/es5-shim.min.js"></script>';
     echo '<script src="//cdnjs.cloudflare.com/ajax/libs/classlist/2014.01.31/classList.min.js"></script>';
     echo '<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>';
     echo '<![endif]-->';
}
