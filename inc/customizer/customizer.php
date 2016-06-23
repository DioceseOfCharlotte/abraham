<?php
/**
 * Theme Customizer.
 *
 * @package Abraham
 */

add_action( 'customize_register', 'abraham_customize_register' );
add_action( 'customize_preview_init', 'abraham_customizer_js' );

/**
 * Customizer Settings
 *
 * @param  array $wp_customize Add controls and settings.
 */
function abraham_customize_register( $wp_customize ) {

	// Customize title and tagline sections and labels.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {

	    $wp_customize->selective_refresh->add_partial( 'blogname', array(
	        'selector' => '#site-title',
	        'render_callback' => function() {
	            return get_bloginfo( 'name', 'display' );
	        },
	    ) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	        'selector' => '#site-description',
	        'render_callback' => function() {
	            return get_bloginfo( 'description', 'display' );
	        },
	    ) );
	}

	// Theme layouts.
	$wp_customize->get_setting( 'theme_layout' )->transport = 'refresh';

	// Add the primary color setting.
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'              => apply_filters( 'theme_mod_primary_color', '' ),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			// 'transport'            => 'postMessage',
		)
	);

	// Add secondary color control.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-primary-color',
			array(
				'label'    => esc_html__( 'Primary Color', 'abraham' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 10,
			)
		)
	);

	// Add the secondary color setting.
	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'              => apply_filters( 'theme_mod_secondary_color', '' ),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			// 'transport'            => 'postMessage',
		)
	);

	/* Add the primary color control. */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-secondary-color',
			array(
				'label'    => esc_html__( 'Secondary Color', 'abraham' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
				'priority' => 15,
			)
		)
	);

	// Add our Footer Customization section section.
    $wp_customize->add_section(
        'abe_footer_section',
        array(
            'title'    => esc_html__( 'Footer Customization', 'abe' ),
            'priority' => 90,
        )
    );

    // Add our copyright text field.
    $wp_customize->add_setting(
        'abe_copyright_text',
        array(
            'default' => ''
        )
    );
    $wp_customize->add_control(
        'abe_copyright_text',
        array(
            'label'       => esc_html__( 'Copyright Text', 'abe' ),
            'description' => esc_html__( 'Displayed in the sites footer.  &#169; 20** will be prepended to this text.', 'abe' ),
            'section'     => 'abe_footer_section',
            'type'        => 'text',
            'sanitize'    => 'html'
        )
    );
}

/**
 * Custom js for theme customizer
 */
function abraham_customizer_js() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'abraham_theme_customizer',
		trailingslashit( get_template_directory_uri() ) . "js/customizer{$suffix}.js",
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
		get_theme_mod( 'heading_font', 'default' ),
		get_theme_mod( 'body_font', 'default' ),
	);
	$font_uri = customizer_library_get_google_font_uri( $fonts );

	wp_enqueue_style( 'google_font_headings', $font_uri, array(), null, 'screen' );
}
