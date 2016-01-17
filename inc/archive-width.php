<?php

add_action( 'init', 'archive_width_taxonomy' );

// Register Custom Taxonomy
function archive_width_taxonomy() {

	register_taxonomy( 'archive_post_width',
		abe_non_hierarchy_cpts(),
		array(
		'public'       => true,
		'hierarchical' => false,
		'labels'       => array(
			'name'          => _x( 'Width', 'post width' ),
			'singular_name' => _x( 'Width', 'post width' ),
		),
		'query_var'         => true,
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
	$prefix = 'doc_';

	/**
	 * Page Styles metabox.
	 */
	$rcdoc_color_meta = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Page Colors', 'cmb2' ),
		'object_types'  => abe_hierarchy_cpts(),
		'context'       => 'side',
		'priority'      => 'high',
		//'show_names' => false,
	) );

		$rcdoc_color_meta->add_field( array(
			'name'       => __( 'Primary Color', 'cmb2' ),
			'desc'       => __( 'Primary color used throughout the page.', 'cmb2' ),
			'id'         => $prefix . 'page_primary_color',
			'type'       => 'colorpicker',
			'default'    => apply_filters('theme_mod_primary_color', ''),
			'priority'   => 'high',
			'attributes' => array(
				'data-colorpicker' => json_encode( array(
					'palettes' => array( '#e87', '#fc6', '#6d7', '#6ca', '#38e', '#a9d' ),
				) ),
			),
		) );

		$rcdoc_color_meta->add_field( array(
			'name'       => __( 'Secondary Color', 'cmb2' ),
			'desc'       => __( 'Secondary color used throughout the page.', 'cmb2' ),
			'id'         => $prefix . 'page_secondary_color',
			'type'       => 'colorpicker',
			'default'    => apply_filters('theme_mod_secondary_color', ''),
			'priority'   => 'high',
			'attributes' => array(
				'data-colorpicker' => json_encode( array(
					'palettes' => array( '#e87', '#fc6', '#6d7', '#6ca', '#38e', '#a9d' ),
				) ),
			),
		) );

}

function get_archive_post_width($post = null) {
	if ( ! $post = get_post( $post ) )
		return false;

	$_width = get_the_terms( $post->ID, 'archive_post_width' );

	if ( empty( $_width ) )
		return false;

	$width = reset( $_width );
		return $width->slug;
}
