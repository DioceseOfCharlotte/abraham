<?php
add_action( 'init', 'archive_width_taxonomy' );

// Register Custom Taxonomy
function archive_width_taxonomy() {

	register_taxonomy( 'archive_post_width',
		array( 'post' ),
		array(
		'public' => true,
		'hierarchical' => false,
		'labels' => array(
			'name' => _x( 'Width', 'post width' ),
			'singular_name' => _x( 'Width', 'post width' ),
		),
		'query_var' => true,
		'show_admin_column' => true,
		//'rewrite' => false,
		'show_ui' => true,
		//'_builtin' => true,
		'show_in_nav_menus' => false,
	) );
}



add_action( 'cmb2_admin_init', 'rcdoc_register_metabox' );
/**
 * Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rcdoc_register_metabox() {
	$prefix = 'rcdoc_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$rcdoc_meta = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array(
			'post',
			// 'page',
			// 'bishop',
			// 'cpt_archive',
			// 'department',
		),
		'context'    => 'side',
		'priority'   => 'high',
		//'show_names' => false,
	) );

	$rcdoc_meta->add_field( array(
		'name'    => __( 'Accent Color', 'cmb2' ),
		'desc'    => __( 'Accent color used throughout the page.', 'cmb2' ),
		'id'      => $prefix . 'colors',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
		'priority'   => 'high',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				'palettes' => array( '#e87', '#fc6', '#6d7', '#6ca', '#38e', '#a9d' ),
			) ),
		),
	) );

	$rcdoc_meta->add_field( array(
		'name'     => __( 'Archive Width', 'cmb2' ),
		'desc'     => __( 'Seen on Landing Page', 'cmb2' ),
		'id'       => $prefix . 'width_taxonomy_radio',
		'type'     => 'taxonomy_radio',
		'taxonomy' => 'archive_post_width', // Taxonomy Slug
		//'inline'  => true, // Toggles display to inline
	) );
}



function get_archive_post_width( $post = null ) {
	if ( ! $post = get_post( $post ) )
		return false;

$_width = get_the_terms( $post->ID, 'archive_post_width' );

if ( empty( $_width ) )
	return false;

	$width = reset( $_width );

return $width->slug;
}
