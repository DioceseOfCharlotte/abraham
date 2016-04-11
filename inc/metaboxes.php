<?php
/**
 * Primary Menu.
 *
 * @package Abraham
 */

add_action( 'cmb2_admin_init', 'abe_register_metaboxes' );

function abe_register_metaboxes() {
	$prefix = 'doc_';

	/**
	* Page Colors metabox.
	*/
	$abe_color_meta = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Page Colors', 'cmb2' ),
		'object_types'  => abe_hierarchy_cpts(),
		'context'       => 'side',
		'priority'      => 'high',
		'show_names' => false,
	) );

	$abe_color_meta->add_field( array(
		'name'       => __( 'Primary Color', 'cmb2' ),
		'id'         => $prefix . 'page_primary_color',
		'type'       => 'colorpicker',
		'default'    => apply_filters( 'theme_mod_primary_color', '' ),
		'attributes' => array(
			'data-colorpicker' => wp_json_encode( array(
				'palettes' => array( '#34495E', '#2980b9', '#39CCCC', '#16a085', '#FFC107', '#F44336' ),
			) ),
		),
	) );

	$abe_color_meta->add_field( array(
		'name'       => __( 'Secondary Color', 'cmb2' ),
		'id'         => $prefix . 'page_secondary_color',
		'type'       => 'colorpicker',
		'default'    => apply_filters( 'theme_mod_secondary_color', '' ),
		'attributes' => array(
			'data-colorpicker' => wp_json_encode( array(
				'palettes' => array( '#34495E', '#2980b9', '#39CCCC', '#16a085', '#FFC107', '#F44336' ),
			) ),
		),
	) );
}
