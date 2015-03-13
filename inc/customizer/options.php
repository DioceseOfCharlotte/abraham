<?php
/**
 * Defines customizer options
 *
 * @package abraham
 */

add_action( 'init', 'customizer_library_abraham_options' );


function customizer_library_abraham_options() {

	// Theme defaults
	$primary_color 		= '#476FBA';
	$secondary_color 	= '#3DC273';
	$body_font			= 'Roboto';
	$heading_font		= 'Raleway';

	// Stores all the controls that will be added
	$options = [];

	// Stores all the sections to be added
	$sections = [];

	// Stores all the panels to be added
	$panels = [];

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Colors
	$section = 'colors';

	$sections[] = [
		'id' => $section,
		'title' => __( 'Colors', 'abraham' ),
		'priority' => '80'
	];

	$options['primary-color'] = [
		'id' => 'primary-color',
		'label'   => __( 'Primary Color', 'abraham' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	];

	$options['secondary-color'] = [
		'id' => 'secondary-color',
		'label'   => __( 'Secondary Color', 'abraham' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	];

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = [
		'id' => $section,
		'title' => __( 'Typography', 'abraham' ),
		'priority' => '80'
	];

	$options['primary-font'] = [
		'id' => 'primary-font',
		'label'   => __( 'Body Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $body_font
	];

	$options['secondary-font'] = [
		'id' => 'secondary-font',
		'label'   => __( 'Heading Font', 'abraham' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $heading_font
	];

	// Decorations
	$section = 'decorations';

	$sections[] = [
		'id' => $section,
		'title' => __( 'Decorations', 'abraham' ),
		'priority' => '80'
	];

	$card_choices = [
	    'card-choice-1' => 'Show Cards',
	    'card-choice-2' => 'Do Not Show Cards'
	];

	$options['cards'] = [
		'id' => 'cards',
		'label'   => __( 'Content Cards', 'abraham' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $card_choices,
    	'default' => 'card-choice-1',
		'description'  => __( 'Displays articles and widgets as blocks of content.', 'abraham' ),
	];

	$shadow_choices = [
	    'shadow-choice-1' => 'Shadows',
	    'shadow-choice-2' => 'No Shadows'
	];

	$options['shadows'] = [
		'id' => 'shadows',
		'label'   => __( 'Card Shadows', 'abraham' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $shadow_choices,
    	'default' => 'shadow-choice-1',
		'description'  => __( 'Shows shadows behind the cards.', 'abraham' ),
	];

	// Footer Settings
	$section = 'footer';
	$sections[] = [
		'id' => $section,
		'title' => __( 'Footer', 'abraham' ),
		'priority' => '100'
	];
	$options['footer-text'] = [
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'abraham' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => abraham_get_default_footer_text(),
	];

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
