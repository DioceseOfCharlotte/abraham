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

add_filter( 'hybrid_attr_archive_wrap',  'archive_wrap' );


/**
 * Adds a custom image size for viewing in the admin edit posts screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function doc_add_image_sizes() {
	add_image_size( 'directory-thumbnail', 60, 60, true );

	/* Adds the 'saga-large' image size. */
	add_image_size( 'dept-thumb', 100, 100, true );
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

		$templates = array_merge( array( "abe-extras/templates/{$post_type}.php" ), $templates );


	return $templates;
}





// FacetWP

add_action( 'init', 'my_init' );

function my_init() {
	add_filter( 'facetwp_index_row', 'my_facetwp_index_row' );
	add_action( 'p2p_created_connection', 'my_p2p_created_connection' );
	add_action( 'p2p_delete_connections', 'my_p2p_delete_connections' );
}

function my_facetwp_index_row( $params ) {
	global $wpdb;

	if ( 'p2p' == $params['facet_name'] ) {

		// get all P2P post IDs related to the current post
		// replace "p2p_connection_name" with the actual name
		$related_post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT p2p_from FROM {$wpdb->prefix}p2p
			WHERE p2p_to = %d AND p2p_type IN ('departments_to_people')",
			$params['post_id']
		) );

		if ( !empty( $related_post_ids ) ) {
			foreach ( $related_post_ids as $related_post_id ) {

				// insert the index rows
				$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->prefix}facetwp_index
					(post_id, facet_name, facet_source, facet_value, facet_display_value) VALUES (%d, %s, %s, %s, %s)",
					$params['post_id'],
					$params['facet_name'],
					$params['facet_source'],
					$related_post_id,
					get_the_title( $related_post_id )
				) );
			}
		}

		// prevent the default indexer query
		return false;
	}

	return $params;
}

// $p2p_id an integer ID
function my_p2p_created_connection( $p2p_id ) {
	$fwp = new FacetWP();
	$connection = p2p_get_connection( $p2p_id );
	$fwp->indexer->index( $connection->p2p_to );
}

// $p2p_ids is an array of IDs
function my_p2p_delete_connections( $p2p_ids ) {
	$fwp = new FacetWP();
	foreach ( $p2p_ids as $p2p_id ) {
		$connection = p2p_get_connection( $p2p_ids );
	   $fwp->indexer->index( $connection->p2p_to );
	}
}



function archive_wrap( $attr ) {

	if ( is_post_type_archive( 'people' ) || is_post_type_archive( 'department' ) ) {

  $attr['class'] .= '  facetwp-template';
}

	return $attr;
}



/**
 * add facetwp tabs above the departments content
 */
function dept_tabs() {
	if ( is_post_type_archive( 'department' ) ) {
echo facetwp_display( 'facet', 'dept_type' );
	}
}
add_action( 'doc_content_top', 'dept_tabs' );