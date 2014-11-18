<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_doc_options() {


	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'logo';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Site Logo', 'doc' ),
		'priority' => '80',
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'doc' ),
		'section' => 'title_tagline',
		'type'    => 'image',
		'default' => '',
	);


	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Typography', 'doc' ),
		'priority' => '80'
	);

	$options['primary-font'] = array(
		'id' => 'primary-font',
		'label'   => __( 'Header Font', 'doc' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Raleway'
	);

	$options['secondary-font'] = array(
		'id' => 'secondary-font',
		'label'   => __( 'Body Font', 'doc' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Fira Sans'
	);

	// More Examples
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer Text', 'doc' ),
		'priority' => '90'
	);

	$options['footer-textarea'] = array(
		'id' => 'footer-textarea',
		'label'   => __( 'Footer Text', 'doc' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => __( 'copyright etc.', 'doc'),
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_doc_options' );
