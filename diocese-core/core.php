<?php
/**
 * Core functions file for the plugin.  This file sets up default actions/filters and defines other functions
 * needed within the plugin.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add custom image sizes (for menu listing in admin). */
add_action( 'init', 'doc_add_image_sizes' );




/**
 * Adds a custom image size for viewing in the admin edit posts screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function doc_add_image_sizes() {
	add_image_size( 'directory-thumbnail', 80, 80, true );
}



/**
 * Filter the template hierarchy so we can add custom templates .
 *
 * @since  1.0.0
 * @access public
 * @return void
 */



add_filter( 'hybrid_content_template_hierarchy', 'doc_content_template_hierarchy' );

function doc_content_template_hierarchy( $templates ) {

	$post_type = get_post_type();

		$templates = array_merge( array( "diocese-core/templates/{$post_type}.php" ), $templates );


	return $templates;
}
