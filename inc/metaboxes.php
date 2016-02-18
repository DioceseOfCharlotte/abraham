<?php

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
		//'desc'       => __( 'Primary color used throughout the page.', 'cmb2' ),
		'id'         => $prefix . 'page_primary_color',
		'type'       => 'colorpicker',
		'default'    => apply_filters('theme_mod_primary_color', ''),
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				'palettes' => array( '#34495E', '#3581ce', '#39CCCC', '#3bc391', '#FFC107', '#F44336' ),
			) ),
		),
	) );

	$abe_color_meta->add_field( array(
		'name'       => __( 'Secondary Color', 'cmb2' ),
		//'desc'       => __( 'Secondary color used throughout the page.', 'cmb2' ),
		'id'         => $prefix . 'page_secondary_color',
		'type'       => 'colorpicker',
		'default'    => apply_filters('theme_mod_secondary_color', ''),
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				'palettes' => array( '#34495E', '#3581ce', '#39CCCC', '#409B63', '#3bc391', '#F44336' ),
			) ),
		),
	) );

	/**
	 * Excerpt/Content metabox.
	 */
	$abe_excerpt_meta = new_cmb2_box( array(
		'id'            => $prefix . 'excerpt_meta',
		'title'         => __( 'Full Content', 'cmb2' ),
		'object_types'  => abe_non_hierarchy_cpts(),
		'context'       => 'side',
		'priority'      => 'default',
		'show_names' => false,
	) );

	$abe_excerpt_meta->add_field( array(
		'name'       => __( 'Full Content', 'cmb2' ),
		'desc'       => __( 'Show the full content rather than excerpt. (Full content is always shown on single pages)', 'cmb2' ),
		'id'         => $prefix . 'show_content',
		'type'       => 'radio_inline',
		'default'    => 'excerpt',
		'options'    => array(
			'excerpt' => __( 'Excerpt', 'cmb2' ),
			'content'   => __( 'Content', 'cmb2' ),
		),
	) );
}
