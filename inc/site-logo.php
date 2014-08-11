<?php
/**
 * Our Site Logo class for managing a theme-agnostic logo through the Customizer.
 *
 * @package Site_Logo
 */
class Site_Logo {
	/**
	 * Stores our single instance.
	 */
	private static $instance;

	/**
	 * Stores our current logo settings.
	 */
	public $logo;

	/**
	 * Return our instance, creating a new one if necessary.
	 *
	 * @uses Site_Logo::$instance
	 * @return object Site_Logo
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Site_Logo;
			self::$instance->register_hooks();
		}

		return self::$instance;
	}

	/**
	 * Get our current logo settings stored in options.
	 *
	 * @uses get_option()
	 */
	private function __construct() {
		$this->logo = get_option( 'site_logo', null );
	}

	/**
	 * Register our actions and filters.
	 *
	 * @uses Site_Logo::head_text_styles()
	 * @uses Site_Logo::customize_register()
	 * @uses Site_Logo::preview_enqueue()
	 * @uses Site_Logo::body_classes()
	 * @uses Site_Logo::media_manager_image_sizes()
	 * @uses add_action
	 * @uses add_filter
	 */
	public function register_hooks() {
		add_action( 'wp_head', array( $this, 'head_text_styles' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'preview_enqueue' ) );
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		add_filter( 'image_size_names_choose', array( $this, 'media_manager_image_sizes' ) );
	}

	/**
	 * Add our logo uploader to the Customizer.
	 *
	 * @param object $wp_customize Customizer object.
	 * @uses current_theme_supports()
	 * @uses current_theme_supports()
	 * @uses WP_Customize_Manager::add_setting()
	 * @uses WP_Customize_Manager::add_control()
	 * @uses Site_Logo::sanitize_checkbox()
	 */
	public function customize_register( $wp_customize ) {
		// Include our custom control.

	require( dirname( __FILE__ ) . '/class-site-logo-control.php' );

		// Add the setting for our logo value.
		$wp_customize->add_setting( 'site_logo', array(
			'default' => array(
				'url' => false,
				'id' => 0,
			),
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'postMessage',
		) );

		// Add our image uploader.
		$wp_customize->add_control( new Site_Logo_Image_Control( $wp_customize, 'site_logo', array(
		    'label'    => __( 'Site Logo', 'site-logo' ),
		    'section'  => 'title_tagline',
		    'settings' => 'site_logo',
		) ) );
	}

	/**
	 * Enqueue scripts for the Customizer live preview.
	 *
	 * @uses wp_enqueue_script()
	 * @uses current_theme_supports()
	 * @uses Site_Logo::header_text_classes()
	 * @uses wp_localize_script()
	 */
	public function preview_enqueue() {
		wp_enqueue_script( 'site-logo-preview', get_template_directory_uri() . '/scripts/site-logo.js', array( 'media-views' ), '', true );
	}

	/**
	 * Get header text classes. If not defined in add_theme_support(), defaults from Underscores will be used.
	 *
	 * @uses get_theme_support
	 * @return string String of classes to hide
	 */
	public function header_text_classes() {
		$args = get_theme_support( 'site-logo' );

		if ( isset( $args[0][ 'header-text' ] ) ) {
			// Use any classes defined in add_theme_support().
			$classes = $args[0][ 'header-text' ];
		} else {
			// Otherwise, use these defaults, which will work with any Underscores-based theme.
			$classes = array(
				'site-title',
				'site-description',
			);
		}

		// If we've got an array, reduce them to a string for output
		if ( is_array( $classes ) ) {
			$classes = (string) '.' . implode( ', .', $classes );
		} else {
			$classes = (string) '.' . $classes;
		}

		return $classes;
	}

	/**
	 * Hide header text on front-end if necessary.
	 *
	 * @uses current_theme_supports()
	 * @uses get_theme_mod()
	 * @uses Site_Logo::header_text_classes()
	 * @uses esc_html()
	 */
	public function head_text_styles() {
		// Bail if our theme supports custom headers.
		if ( current_theme_supports( 'custom-header' ) ) {
			return;
		}

		// Is Display Header Text unchecked? If so, we need to hide our header text.
		if ( ! get_theme_mod( 'site_logo_header_text', 1 ) ) {
			$classes = $this->header_text_classes();
			?>
			<!-- Site Logo: hide header text -->
			<style type="text/css">
			<?php echo esc_html( $classes ); ?> {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			</style>
			<?php
		}
	}

	/**
	 * Determine image size to use for the logo.
	 *
	 * @uses get_theme_support()
	 * @return string Size specified in add_theme_support declaration, or 'thumbnail' default
	 */
	public function theme_size() {
		$valid_sizes = array( 'thumbnail', 'medium', 'large', 'full' );

		global $_wp_additional_image_sizes;
		if ( isset( $_wp_additional_image_sizes ) ) {
			$valid_sizes = array_merge( $valid_sizes, array_keys( $_wp_additional_image_sizes ) );
		}

		$args = get_theme_support( 'site-logo' );

		$size = ( isset( $args[0]['size'] ) && in_array( $args[0]['size'], $valid_sizes ) ) ? $args[0]['size'] : 'thumbnail';

		return $size;
	}

	/**
	 * Make custom image sizes available to the media manager.
	 *
	 * @param array $sizes
	 * @global array $_wp_additional_image_sizes
	 * @return array All default and registered custom image sizes.
	 */
	public function media_manager_image_sizes( $sizes ) {
		global $_wp_additional_image_sizes;

		if ( isset( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $size => $value ) {
				$sizes[ $size ] = '';
			}
		}

		return $sizes;
	}

	/**
	 * Determine if a site logo is assigned or not.
	 *
	 * @uses Site_Logo::$logo
	 * @return boolean True if there is an active logo, false otherwise
	 */
	public function has_site_logo() {
		return ( isset( $this->logo['id'] ) && 0 !== $this->logo['id'] ) ? true : false;
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @uses Site_Logo::has_site_logo()
	 * @return array Array of <body> classes
	 */
	public function body_classes( $classes ) {
		// Add a class if a Site Logo is active
		if ( $this->has_site_logo() ) {
			$classes[] = 'has-site-logo';
		}

		return $classes;
	}

	/**
	 * Sanitize our header text Customizer setting.
	 *
	 * @param $input
	 * @return mixed 1 if checked, empty string if not checked.
	 */
	public function sanitize_checkbox( $input ) {
		return ( 1 == $input ) ? 1 : '';
	}
}

/**
 * Allow themes and plugins to access Site_Logo methods and properties.
 *
 * @uses Site_Logo::instance()
 * @return object Site_Logo
 */
function site_logo() {
	return Site_Logo::instance();
}

/**
 * One site logo, please.
 */
site_logo();

/**
 * Functions and template tags for using site logos.
 *
 * @package Site_Logo
 */

/**
 * Retrieve the site logo URL or ID (URL by default). Pass in the string 'id' for ID.
 *
 * @uses get_option()
 * @uses esc_url_raw()
 * @uses set_url_scheme()
 * @return mixed The URL or ID of our site logo, false if not set
 * @since 1.0
 */
function get_site_logo( $show = 'url' ) {
	$logo = site_logo()->logo;

	// Return false if no logo is set
	if ( ! isset( $logo['id'] ) || 0 == $logo['id'] ) {
		return false;
	}

	// Return the ID if specified, otherwise return the URL by default
	if ( 'id' == $show ) {
		return $logo['id'];
	} else {
		return esc_url_raw( set_url_scheme( $logo['url'] ) );
	}
}

/**
 * Determine if a site logo is assigned or not.
 *
 * @uses get_option
 * @return boolean True if there is an active logo, false otherwise
 */
function has_site_logo() {
	return site_logo()->has_site_logo();
}

/**
 * Output an <img> tag of the site logo, at the size specified
 * in the theme's add_theme_support() declaration.
 *
 * @uses current_theme_supports()
 * @uses get_option()
 * @uses site_logo_theme_size()
 * @uses site_logo_is_customize_preview()
 * @uses esc_url()
 * @uses home_url()
 * @uses esc_attr()
 * @uses wp_get_attachment_image()
 * @since 1.0
 */
function the_site_logo() {
	$logo = site_logo()->logo;
	$size = site_logo()->theme_size();

	// Bail if no logo is set. Leave a placeholder if we're in the Customizer, though (needed for the live preview).
	if ( ! has_site_logo() ) {
		if ( site_logo_is_customize_preview() ) {
			printf( '<a href="%1$s" class="site-logo-anchor" style="display:none;"><img class="site-logo" data-size="%2$s" /></a>',
				esc_url( home_url( '/' ) ),
				esc_attr( $size )
			);
		}
		return;
	}

	// We have a logo. Logo is go.
	$html = sprintf( '<a href="%1$s" class="site-logo-anchor" rel="home">%2$s</a>',
		esc_url( home_url( '/' ) ),
		wp_get_attachment_image(
			$logo['id'],
			$size,
			false,
			array(
				'class'     => "site-logo attachment-$size",
				'data-size' => $size,
			)
		)
	);

	echo apply_filters( 'the_site_logo', $html, $logo, $size );
}

/**
 * Whether the site is being previewed in the Customizer.
 * Duplicate of core function until WP.com has merged 4.0.
 *
 * @since 4.0.0
 *
 * @global WP_Customize_Manager $wp_customize Customizer instance.
 *
 * @return bool True if the site is being previewed in the Customizer, false otherwise.
 */
function site_logo_is_customize_preview() {
	global $wp_customize;

	return is_a( $wp_customize, 'WP_Customize_Manager' ) && $wp_customize->is_preview();
}