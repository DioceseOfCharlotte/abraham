<?php
/**
 * Sets up the admin functionality for the plugin.
 *
 * @package    Directory
 * @subpackage Admin
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Sets up the adminstration functionality for the framework and themes.
 *
 * @since  1.3.0
 * @access public
 * @return void
 */
add_action( 'admin_enqueue_scripts', 'load_doc_admin_style' );

function load_doc_admin_style() {
        wp_register_style( 'doc_admin_css', trailingslashit( DOC_CSS ) . 'directory.css', false, '1.0.0' );
        wp_enqueue_style( 'doc_admin_css' );
}
