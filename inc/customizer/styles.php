<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package abraham
 */

function color_inverse($color){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = 255 - hexdec(substr($color,(2*$x),2));
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return '#'.$rgb;
}

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

		$color = sanitize_hex_color( $mod );
		$rgb = join( ', ', hybrid_hex_to_rgb( $color ) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.menu__primary,
				.btn,
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.button'
			),
			'declarations' => array(
				'background-color' => $color,
				'color' => color_inverse($color)
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.btn:hover,
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.button:hover'
			),
			'declarations' => array(
				'background-color' => "rgba( {$rgb}, 0.85 )"
			)
		) );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header'
			),
			'declarations' => array(
				'background-color' => "rgba( {$rgb}, 0.75 )"
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
