<?php
/**
 * abraham Theme Customizer.
 */

// function wpt_register_theme_customizer( $wp_customize ) {

//     var_dump( $wp_customize );

// }
// add_action( 'customize_register', 'wpt_register_theme_customizer' );

$includes_dir = trailingslashit(get_template_directory());

require_once $includes_dir.'inc/customizer/custom-header.php';
require_once $includes_dir.'inc/customizer/Color.php';
require_once $includes_dir.'inc/customizer/fonts.php';
require_once $includes_dir.'inc/customizer/custom-styles.php';

add_action('customize_register', 'abraham_customize_register', 11);
add_action('customize_preview_init', 'abraham_customizer_js');
add_action('wp_enqueue_scripts', 'abraham_google_fonts');

function abraham_customize_register($wp_customize) {

	// Customize title and tagline sections and labels
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	// Theme layouts
	$wp_customize->get_setting('theme_layout')->transport = 'refresh';

	$wp_customize->add_setting(
	  'abraham_logo',
	  array(
		  'type'      => 'theme_mod', // or 'option'
		  'default'   => '',
		  'transport' => 'refresh', // or postMessage
	  )
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'custom-logo',
			array(
				'section'     => 'title_tagline',
				'settings'    => 'abraham_logo',
				'label'       => esc_html__('Your Logo', 'abraham'),
	) ) );

	/* Add the primary color setting. */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'              => apply_filters('theme_mod_primary_color', ''),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			//'transport'            => 'postMessage',
		)
	);

	/* Add secondary color control. */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-primary-color',
			array(
				'label'    => esc_html__('Primary Color', 'abraham'),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 10,
			)
		)
	);

	/* Add the secondary color setting. */
	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'              => apply_filters('theme_mod_secondary_color', ''),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			//'transport'            => 'postMessage',
		)
	);

	/* Add the primary color control. */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-secondary-color',
			array(
				'label'    => esc_html__('Secondary Color', 'abraham'),
				'section'  => 'colors',
				'settings' => 'secondary_color',
				'priority' => 15,
			)
		)
	);

  //Typography

	$wp_customize->add_section(
		'custom_typography',
		array(
		'title'    => esc_html__('Typography', 'abraham'),
		'priority' => 80,
		)
	);

	/* Adds the heading font setting. */
	$wp_customize->add_setting(
		'heading_font',
		array(
			'default'              => 'serif',
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_text_field',
			//'transport'            => 'postMessage',
		)
	);
	/* Adds the heading font control. */
	$wp_customize->add_control(
		'abraham-heading-font',
		array(
			'label'    => esc_html__('Heading Font', 'abraham'),
			'section'  => 'custom_typography',
			'settings' => 'heading_font',
			'type'     => 'select',
			'choices'  => customizer_library_get_font_choices(),
		)
	);

	/* Adds the body font setting. */
	$wp_customize->add_setting(
		'body_font',
		array(
			'default'              => 'sans-serif',
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_text_field',
			//'transport'            => 'postMessage',
		)
	);
	/* Adds the body font control. */
	$wp_customize->add_control(
		'abraham-body-font',
		array(
			'label'    => esc_html__('Body Font', 'abraham'),
			'section'  => 'custom_typography',
			'settings' => 'body_font',
			'type'     => 'select',
			'choices'  => customizer_library_get_font_choices(),
		)
	);
}

// Custom js for theme customizer
function abraham_customizer_js() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'abraham_theme_customizer',
		trailingslashit( get_template_directory_uri() ) . "assets/js/customizer{$suffix}.js",
		array( 'customize-preview' ),
		null,
		true
	);
}

/**
 * Enqueue Google Fonts.
 */
function abraham_google_fonts() {
	$fonts = array(
		get_theme_mod('heading_font', 'default'),
		get_theme_mod('body_font', 'default'),
	);
	$font_uri = customizer_library_get_google_font_uri($fonts);

	wp_enqueue_style( 'google_font_headings', $font_uri, array(), null, 'screen' );
}
