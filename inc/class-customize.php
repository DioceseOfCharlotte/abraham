<?php
/**
 * Handles the theme's theme customizer functionality.
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Abe_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'mods' ) );
		add_action( 'customize_register', array( $this, 'partials' ) );
		add_action( 'customize_register', array( $this, 'site_layout' ) );
		add_action( 'customize_register', array( $this, 'colors' ) );
		add_action( 'customize_register', array( $this, 'info' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'control_enqueue' ), 0 );

		// Enqueue scripts and styles for the preview.
		add_action( 'customize_preview_init', array( $this, 'preview_enqueue' ) );
	}

	/**
	 * Modify core WP controls.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize
	 * @return void
	 */
	public function mods( $wp_customize ) {

		// Customize title and tagline sections and labels.
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}

	/**
	 * Sets up the customizer partials.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize
	 * @return void
	 */
	public function partials( $wp_customize ) {

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '#site-title',
				'render_callback' => function() {
					return bloginfo( 'name' );
				},
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector' => '#site-description',
				'render_callback' => function() {
					return bloginfo( 'description' );
				},
			)
		);
	}

	/**
	 * Sets up the customizer settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize
	 * @return void
	 */
	public function site_layout( $wp_customize ) {
		// mod hybrid layouts controls.
		$wp_customize->get_setting( 'theme_layout' )->transport = 'refresh';
		$wp_customize->get_section( 'layout' )->panel = 'abe_layouts';
		$wp_customize->get_section( 'layout' )->title = __( 'Content Layout', 'abe' );
		$wp_customize->get_control( 'theme_layout' )->label = __( 'Content Layout', 'abe' );

		$wp_customize->add_panel(
			'abe_layouts',
			array(
				'priority' => 30,
				'title'    => __( 'Site Layout', 'abe' ),
			)
		);

		$wp_customize->add_section(
			'abe_header',
			array(
				'title'    => __( 'Header Layout', 'abe' ),
				'description' => __( '<h1>THIS SECTION IS NOT YET FUNCTIONAL.</h1>' ),
				'panel' => 'abe_layouts',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting( 'header_behavior', array(
			'default'              => 'scroll',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field', // Custom function in customizer-sanitization.php file.
		) );

		$wp_customize->add_control( 'header_behavior', array(
			'label'       => __( 'Header Behavior', 'abe' ),
			'section'     => 'abe_header',
			'type'        => 'select',
			'choices'  => array(
				'scroll'  => 'Scroll',
				'fixed' => 'Fixed',
			),
		) );

		$wp_customize->add_setting( 'logo_position', array(
			'default'              => 'logo-left',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field', // Custom function in customizer-sanitization.php file.
		) );

		$wp_customize->add_control(
			new Hybrid_Customize_Control_Radio_Image(
				$wp_customize,
				'logo_position', array(
					'label'       => __( 'Title Placement', 'abe' ),
					'section'     => 'abe_header',
					'choices'  => array(
						'logo-left' => array(
							'label' => esc_html__( 'Logo Left', 'abe' ),
							'url'   => '%s/images/logo-left.svg',
						),
						'logo-right' => array(
							'label' => esc_html__( 'Logo Right', 'abe' ),
							'url'   => '%s/images/logo-right.svg',
						),
						'logo-center' => array(
							'label' => esc_html__( 'Logo Center', 'abe' ),
							'url'   => '%s/images/logo-center.svg',
						),
					),
				)
			)
		);

		$wp_customize->add_setting( 'nav_position', array(
			'default'              => 'menu-right',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field', // Custom function in customizer-sanitization.php file.
		) );

		$wp_customize->add_control(
			new Hybrid_Customize_Control_Radio_Image(
				$wp_customize,
				'nav_position', array(
					'label'       => __( 'Menu Placement', 'abe' ),
					'section'     => 'abe_header',
					'choices'  => array(
						'menu-left' => array(
							'label' => esc_html__( 'Menu Left', 'abe' ),
							'url'   => '%s/images/menu-left.svg',
						),
						'menu-right' => array(
							'label' => esc_html__( 'Menu Right', 'abe' ),
							'url'   => '%s/images/menu-right.svg',
						),
						'menu-top' => array(
							'label' => esc_html__( 'Menu Top', 'abe' ),
							'url'   => '%s/images/menu-top.svg',
						),
						'menu-bottom' => array(
							'label' => esc_html__( 'Menu bottom', 'abe' ),
							'url'   => '%s/images/menu-bottom.svg',
						),
					),
				)
			)
		);
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize
	 * @return void
	 */
	public function colors( $wp_customize ) {

		// Add the primary color setting.
		$wp_customize->add_setting(
			'primary_color',
			array(
				'default'              => apply_filters( 'theme_mod_primary_color', '' ),
				'type'                 => 'theme_mod',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage',
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

		// Add the primary color setting.
		$wp_customize->add_setting(
			'background_color',
			array(
				'default'              => apply_filters( 'theme_mod_background_color', '' ),
				'type'                 => 'theme_mod',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage',
			)
		);

		// Add secondary color control.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'custom-background-color',
				array(
					'label'    => esc_html__( 'Background Color', 'abraham' ),
					'section'  => 'colors',
					'settings' => 'background_color',
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
				'transport'            => 'postMessage',
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
	}

	/**
	 * Sets up the customizer settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize
	 * @return void
	 */
	public function info( $wp_customize ) {

		// Add our API Customization section section.
		$wp_customize->add_section(
			'meh_api_section',
			array(
				'title'    => esc_html__( 'Owner Info and APIs', 'abe' ),
				'priority' => 90,
			)
		);

			// Add our copyright text field.
			$wp_customize->add_setting(
				'abe_copyright_text',
				array(
					'default' => '',
				)
			);
			$wp_customize->add_control(
				'abe_copyright_text',
				array(
					'label'       => esc_html__( 'Copyright Text', 'abe' ),
					'description' => abe_hint( 'Displayed in the site\'s footer. &#169; 20** will be prepended to this text.' ),
					'section'     => 'meh_api_section',
					'type'        => 'text',
					'sanitize'    => 'html',
				)
			);

			// Add ga text field.
			$wp_customize->add_setting(
				'abe_analytics_id',
				array(
					'default' => '',
				)
			);
			$wp_customize->add_control(
				'abe_analytics_id',
				array(
					'label'             => esc_html__( 'Google Analytics ID', 'abe' ),
					'description'       => esc_html__( 'UA-XXXXX-Y', 'abe' ),
					'section'           => 'meh_api_section',
					'type'              => 'text',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function control_enqueue() {

		wp_enqueue_style(
			'abe-tooltip-controls', get_template_directory_uri() . '/css/hint.css'
		);
	}

	/**
	 * Loads theme customizer JavaScript.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function preview_enqueue() {

		wp_enqueue_script(
			'abraham_theme_customizer', get_template_directory_uri() . '/js/customizer-preview.js',
			array( 'customize-preview' ),
			null,
			true
		);
	}
}

// Doing this customizer thang!
Abe_Customize::get_instance();
