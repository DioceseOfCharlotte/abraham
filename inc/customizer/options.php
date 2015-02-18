<?php
/**
 * Defines customizer options
 *
 * @package abraham
 */

function customizer_library_abraham_options() {

	// Theme defaults
	$primary_color 		= '#607D8B';
	$secondary_color 	= '#9E9E9E';
	$body_font			= 'Roboto';
	$heading_font		= 'Merriweather';

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
		'priority' => '20'
	);
	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'abraham' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
	);
	$options['logo-favicon'] = array(
		'id' => 'logo-favicon',
		'label'   => __( 'Favicon', 'abraham' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>32px x 32px</strong>.', 'abraham' ),
	);
	$options['logo-apple-touch'] = array(
		'id' => 'logo-apple-touch',
		'label'   => __( 'Apple Touch Icon', 'abraham' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>152px x 152px</strong>.', 'abraham' ),
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
		'label'   => __( 'Body Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $body_font
	);

	$options['secondary-font'] = array(
		'id' => 'secondary-font',
		'label'   => __( 'Heading Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $heading_font
	);

	// Decorations
	$section = 'decorations';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Decorations', 'abraham' ),
		'priority' => '80'
	);

	$card_choices = array(
	    'card-choice-1' => 'Show Cards',
	    'card-choice-2' => 'Do Not Show Cards'
	);

	$options['cards'] = array(
		'id' => 'cards',
		'label'   => __( 'Content Cards', 'abraham' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $card_choices,
    	'default' => 'card-choice-1',
		'description'  => __( 'Displays articles and widgets as blocks of content.', 'abraham' ),
	);

	$shadow_choices = array(
	    'shadow-choice-1' => 'Shadows',
	    'shadow-choice-2' => 'No Shadows'
	);

	$options['shadows'] = array(
		'id' => 'shadows',
		'label'   => __( 'Card Shadows', 'abraham' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $shadow_choices,
    	'default' => 'shadow-choice-1',
		'description'  => __( 'Shows shadows behind the cards.', 'abraham' ),
	);

	// Footer Settings
	$section = 'footer';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'abraham' ),
		'priority' => '100'
	);
	$options['footer-text'] = array(
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'abraham' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => abraham_get_default_footer_text(),
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
