<?php
/**
 * Defines customizer options
 *
 * @package abraham
 */

function customizer_library_abraham_options() {

	// Theme defaults
	$primary_color = '#455A64';
	$secondary_color = '#9E9E9E';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'logo';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Logo', 'abraham' ),
		'priority' => '30',
		'description' => __( 'Your logo.', 'abraham' )
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'abraham' ),
		'section' => $section,
		'type'    => 'image',
		'default' => ''
	);

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'abraham' ),
		'priority' => '80'
	);

	$options['primary-color'] = array(
		'id' => 'primary-color',
		'label'   => __( 'Primary Color', 'abraham' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	$options['secondary-color'] = array(
		'id' => 'secondary-color',
		'label'   => __( 'Secondary Color', 'abraham' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);

	$options['border'] = array(
		'id' => 'border',
		'label'   => __( 'Border Color', 'abraham' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Typography', 'abraham' ),
		'priority' => '80'
	);

	$options['primary-font'] = array(
		'id' => 'primary-font',
		'label'   => __( 'Primary Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Roboto'
	);

	$options['secondary-font'] = array(
		'id' => 'secondary-font',
		'label'   => __( 'Secondary Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Merriweather'
	);

	// Footer
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'abraham' ),
		'priority' => '90'
	);

	$options['footer-text'] = array(
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'abraham' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => __( 'Text to go in the footer.', 'abraham'),
	);

	// Panel Example
	$panel = 'footer-panel';

	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Footer', 'abraham' ),
		'priority' => '90'
	);

	$section = 'footer-text-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Text', 'abraham' ),
		'priority' => '10',
		'panel' => $panel
	);

	$options['footer-text'] = array(
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'abraham' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => __( 'Text to go in the footer.', 'abraham'),
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_abraham_options' );
