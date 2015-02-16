<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package abraham
 */

if ( ! function_exists( 'customizer_library_abraham_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_abraham_styles() {

	// Primary Color
	$setting = 'primary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$simple_color_adjuster = new Simple_Color_Adjuster;
		$color = sanitize_hex_color( $mod );
		$rgb = join( ', ', hybrid_hex_to_rgb( $color ) );
		$percentage = 10;
		$darken 	= $simple_color_adjuster->darken( $color, $percentage );
		$lighten 	= $simple_color_adjuster->lighten( $color, $percentage );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu__primary,
				a.btn,
				.btn,
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.button'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'blockquote,
				input[type="email"]:focus,
				input[type="number"]:focus,
				input[type="search"]:focus,
				input[type="text"]:focus,
				input[type="tel"]:focus,
				input[type="url"]:focus,
				input[type="password"]:focus,
				textarea:focus,
				select:focus'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header,
				a.btn:hover,
				.btn:hover,
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.button:hover'
			),
			'declarations' => array(
				'background-color' => $lighten
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header,
				a.btn:active,
				.btn:active,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.button:active'
			),
			'declarations' => array(
				'background-color' => $darken
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.featured-media>a'
			),
			'declarations' => array(
				'background-color' => $darken
			)
		) );

	}

	// Secondary Color
	$setting = 'secondary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );
		$rgb = join( ', ', hybrid_hex_to_rgb( $color ) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}


	// Primary Font
	$setting = 'primary-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}

	// Decorations
	$setting = 'cards';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry, .widget, .comments'
			),
			'declarations' => array(
				'background' => 'none',
				'box-shadow' => 'none',
				'border' => '0'
			)
		) );
	}

	// Card Shadows
	$setting = 'shadows';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.entry, .widget, .comments'
			),
			'declarations' => array(
				'box-shadow' => 'none',
				'border' => '0'
			)
		) );
	}

	// Secondary Font
	$setting = 'secondary-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}

}
endif;

add_action( 'customizer_library_styles', 'customizer_library_abraham_styles' );

if ( ! function_exists( 'abraham_display_customizations' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function abraham_display_customizations() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"abraham-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'abraham_display_customizations', 11 );
