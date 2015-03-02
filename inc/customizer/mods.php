<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Demo
 */


add_action( 'wp_enqueue_scripts', 'abraham_custom_fonts' );

add_action('wp_head','abraham_touch_icon');

add_action( 'customize_controls_init', 'abraham_customize_css' );

add_action( 'admin_print_styles', 'abraham_admin_styles' );

/**
 * Enqueue Google Fonts Example.
 */
function abraham_custom_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'primary-font', customizer_library_get_default( 'primary-font' ) ),
		get_theme_mod( 'secondary-font', customizer_library_get_default( 'secondary-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'abraham_custom_fonts', $font_uri, array(), null, 'screen' );

}




/**
 * Apple touch icon.
 */
function abraham_touch_icon() {

	if ( get_theme_mod( 'logo-apple-touch', 0 ) ) {
		$output = '<link rel="apple-touch-icon" href="' . esc_url( get_theme_mod( 'logo-apple-touch' ) ) . '">';

	echo $output;
	}

	if ( get_theme_mod( 'logo-favicon', 0 ) ) {
		$output = '<link rel="Shortcut Icon" href="' . esc_url( get_theme_mod( 'logo-favicon' ) ) . '">';

	echo $output;
	}
}

/**
 * Adds visual selectors for the layout option in the Theme Customizer.
 */
function abraham_customize_css() { ?>

	<style type="text/css">
		#customize-control-theme-layout-control input[value="1c"]:before {
			content: "\f134";
		}
		#customize-control-theme-layout-control input[value="2c-l"]:before {
			content: "\f135";
		}
		#customize-control-theme-layout-control input[value="2c-r"]:before {
			content: "\f136";
		}
		#customize-control-theme-layout-control input[type=radio] {
			font-family: dashicons;
			font-size: 32px;
		  	margin-right: 20px;
			color: #ddd;
			border: 0;
			line-height: 0;
			height: 0;
			width: 0;
		}
		#customize-control-theme-layout-control input[type=radio]:checked:before {
			color: #888;
			text-indent: 0;
			-webkit-border-radius: 0;
			border-radius: 0;
			font-size: 32px;
			width: 0;
			height: 0;
			margin: 0;
			line-height: 0;
			background: none;
		}
	</style>
<?php }

/**
 * Adds visual selectors for the layout option in the Post Admin.
 */
function abraham_admin_styles() {
	?>
	<style type="text/css">
		#theme-layouts-post-meta-box input[value=default]:before {
			content: "\f159";
		}
		#theme-layouts-post-meta-box input[value="1c"]:before {
			content: "\f134";
		}
		#theme-layouts-post-meta-box input[value="2c-l"]:before {
			content: "\f135";
		}
		#theme-layouts-post-meta-box input[value="2c-r"]:before {
			content: "\f136";
		}
		#theme-layouts-post-meta-box input[type=radio] {
			font-family: dashicons;
			font-size: 32px;
		  	margin-right: 20px;
			color: #ddd;
			border: 0;
			line-height: 0;
			height: 0;
			width: 0;
		}
		#theme-layouts-post-meta-box input[type=radio]:checked:before {
			color: #888;
			text-indent: 0;
			-webkit-border-radius: 0;
			border-radius: 0;
			font-size: 32px;
			width: 0;
			height: 0;
			margin: 0;
			line-height: 0;
			background: none;
		}
		#theme-layouts-post-meta-box li {
		  margin-bottom: 15px;
		}
	</style>
	<?php
}
