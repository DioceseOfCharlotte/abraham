<?php
/**
 * Handles the custom colors feature for the theme.
 */

use Mexitek\PHPColors\Color;

/**
 * Handles custom theme color options via the WordPress theme customizer.
 *
 * @since  1.0.0
 */
final class Abraham_Custom_Styles {
	/**
	 * Holds the instance of this class.
	 *
	 * @since  1.0.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Sets up the Custom Colors Palette feature.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {

		/* Output CSS into <head>. */
		add_action( 'wp_head', array( $this, 'wp_head_callback' ) );

		/* Add a '.custom-styles' <body> class. */
		add_filter( 'body_class', array( $this, 'body_class' ) );

		/* Filter the default colors late. */
		add_filter( 'theme_mod_primary_color', array( $this, 'primary_color_default' ), 95 );
		add_filter( 'theme_mod_secondary_color', array( $this, 'secondary_color_default' ), 95 );
	}

	/**
	 * Returns a default colors if there is none set.  We use this instead of
	 * setting a default so that child themes can overwrite the default early.
	 *
	 * @since  1.0.0
	 *
	 * @param string $hex
	 *
	 * @return string
	 */
	public function primary_color_default( $hex ) {
		global $cptarchives;
		if ( $GLOBALS['cptarchives'] ) {
			$landing_prime_color = $cptarchives->get_archive_meta( 'doc_page_primary_color', true );
		}

		$post_prime_color = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );

		if ( $post_prime_color && ! is_front_page() && ! is_post_type_archive() ) {
			return trim( $post_prime_color, '#' ); }

		if ( $GLOBALS['cptarchives'] && $landing_prime_color && ! is_front_page() ) {
			return trim( $landing_prime_color, '#' ); }

		return $hex ? $hex : '2980b9';
	}

	public function secondary_color_default( $hex ) {
		global $cptarchives;
		if ( $GLOBALS['cptarchives'] ) {
			$landing_second_color = $cptarchives->get_archive_meta( 'doc_page_secondary_color', true );
		}
		$post_second_color = get_post_meta( get_the_ID(), 'doc_page_secondary_color', true );

		if ( $post_second_color && ! is_front_page() && ! is_post_type_archive() ) {
			return trim( $post_second_color, '#' ); }

		if ( $GLOBALS['cptarchives'] && $landing_second_color && ! is_front_page() ) {
			return trim( $landing_second_color, '#' ); }

		return $hex ? $hex : '16a085';
	}

	/**
	 * Adds the 'custom-styles' class to the <body> element.
	 *
	 * @since  1.0.0
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	public function body_class( $classes ) {
		$classes[] = 'custom-styles';

		return $classes;
	}

	/**
	 * Callback for 'wp_head' that outputs the CSS for this feature.
	 *
	 * @since  1.0.0
	 */
	public function wp_head_callback() {
		$style = $this->get_primary_styles();
		$style .= $this->get_secondary_styles();
		$style .= $this->get_abe_font_styles();
		/* Put the final style output together. */
		$style = "\n".'<style id="custom-colors-css">'.trim( $style ).'</style>'."\n";

		/* Output the custom style. */
		echo $style;
	}

	/**
	 * Formats the primary styles for output.
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	public function get_primary_styles() {
		$style = '';
		$hex   = get_theme_mod( 'primary_color', '' );
		$rgb   = implode( ', ', hybrid_hex_to_rgb( $hex ) );

		$primaryColor = new Color( $hex );
		$color50      = $primaryColor->lighten( 45 );
		$color100     = $primaryColor->lighten( 40 );
		$color200     = $primaryColor->lighten( 30 );
		$color300     = $primaryColor->lighten( 20 );
		$color400     = $primaryColor->lighten( 10 );
		$color500     = $hex;
		$color600     = $primaryColor->darken( 10 );
		$color700     = $primaryColor->darken( 20 );
		$color800     = $primaryColor->darken( 30 );
		$color900     = $primaryColor->darken( 40 );

		$colorBase = $color500;
		$colorDark = $primaryColor->isDark( $color300 ) ? $color400 : $color600;
		$colorLight = $primaryColor->isDark( $color300 ) ? $color100 : $color300;

		$textBase = $primaryColor->isDark( $colorBase ) ? 'fff' : '333';
		$textOnDark = $primaryColor->isDark( $colorDark ) ? 'fff' : '333';
		$textOnLight = $primaryColor->isDark( $colorLight ) ? 'fff' : '333';

		$glass          = implode( ', ', hybrid_hex_to_rgb( $colorBase ) );
		$glass_dark     = implode( ', ', hybrid_hex_to_rgb( $colorDark ) );
		$glass_light    = implode( ', ', hybrid_hex_to_rgb( $colorLight ) );
		$textRGB = implode( ', ', hybrid_hex_to_rgb( $textBase ) );

		/* === Color === */

		$style .= "#page .u-text-1,.u-dropcap:first-letter{color:#{$colorBase}}";
		$style .= "#page .u-text-1-dark{color:#{$colorDark}}";
		$style .= "#page .u-text-1-light{color:#{$colorLight}}";
		$style .= "#page .u-bg-1{background-color:#{$colorBase};color:#{$textBase};}";
		$style .= "#page .u-bg-1-light{background-color:#{$colorLight};color:#{$textOnLight};}";
		$style .= "#page .u-bg-1-dark{background-color:#{$colorDark};color:#{$textOnDark};}";
		$style .= "#page .u-bg-1-glass{background-color:rgba( {$glass}, 0.98 );color:#{$textBase};}";
		$style .= "#page .u-bg-1-glass-light{background-color:rgba( {$glass_light}, 0.98 );color:#{$textOnLight};}";
		$style .= "#page .u-bg-1-glass-dark{background-color:rgba( {$glass_dark}, 0.98 );color:#{$textOnDark};}";
		$style .= "#page .u-fill-1{fill:#{$colorBase}}";
		$style .= "#page .u-fill-1-light{fill:#{$colorLight}}";
		$style .= "#page .u-fill-1-dark{fill:#{$colorDark}}";

		/* Return the styles. */
		return str_replace( array( "\r", "\n", "\t" ), '', $style );
	}

	/**
	 * Formats the secondary styles for output.
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	public function get_secondary_styles() {
		$style = '';
		$hex   = get_theme_mod( 'secondary_color', '' );
		$rgb   = implode( ', ', hybrid_hex_to_rgb( $hex ) );

		$secondaryColor = new Color( $hex );
		$color50        = $secondaryColor->lighten( 45 );
		$color100       = $secondaryColor->lighten( 40 );
		$color200       = $secondaryColor->lighten( 30 );
		$color300       = $secondaryColor->lighten( 20 );
		$color400       = $secondaryColor->lighten( 10 );
		$color500       = $hex;
		$color600       = $secondaryColor->darken( 10 );
		$color700       = $secondaryColor->darken( 20 );
		$color800       = $secondaryColor->darken( 30 );
		$color900       = $secondaryColor->darken( 40 );

		$colorBase = $color500;
		$colorDark = $secondaryColor->isDark( $color300 ) ? $color400 : $color600;
		$colorLight = $secondaryColor->isDark( $color300 ) ? $color100 : $color300;

		$textBase = $secondaryColor->isDark( $colorBase ) ? 'fff' : '333';
		$textOnDark = $secondaryColor->isDark( $colorDark ) ? 'fff' : '333';
		$textOnLight = $secondaryColor->isDark( $colorLight ) ? 'fff' : '333';

		$glass          = implode( ', ', hybrid_hex_to_rgb( $colorBase ) );
		$glass_dark     = implode( ', ', hybrid_hex_to_rgb( $colorDark ) );
		$glass_light    = implode( ', ', hybrid_hex_to_rgb( $colorLight ) );
		$textRGB = implode( ', ', hybrid_hex_to_rgb( $textBase ) );

		/* === Color === */

		$style .= "#page .u-text-2{color:#{$colorBase}}";
		$style .= "#page .u-text-2-dark{color:#{$colorDark}}";
		$style .= "#page .u-text-2-light{color:#{$colorLight}}";
		$style .= "#page .u-bg-2{background-color:#{$colorBase};color:#{$textBase};}";
		$style .= "#page .u-bg-2-light{background-color:#{$colorLight};color:#{$textOnLight};}";
		$style .= "#page .u-bg-2-dark{background-color:#{$colorDark};color:#{$textOnDark};}";
		$style .= "#page .u-bg-2-glass{background-color:rgba( {$glass}, 0.98 );color:#{$textBase};}";
		$style .= "#page .u-bg-2-glass-light{background-color:rgba( {$glass_light}, 0.98 );color:#{$textOnLight};}";
		$style .= "#page .u-bg-2-glass-dark{background-color:rgba( {$glass_dark}, 0.98 );color:#{$textOnDark};}";
		$style .= "#page .u-fill-2{fill:#{$colorBase}}";
		$style .= "#page .u-fill-2-light{fill:#{$colorLight}}";
		$style .= "#page .u-fill-2-dark{fill:#{$colorDark}}";
		$style .= "a:not(.btn):before,a:not(.btn):after{color:#{$colorLight}}";
		$style .= "a:not(.btn):hover:before,a:not(.btn):hover:after{color:#{$colorDark}}";

		/* Return the styles. */
		return str_replace( array( "\r", "\n", "\t" ), '', $style );
	}

	function get_abe_font_styles() {
		$font        = '';
		$h_family = get_theme_mod( 'heading_font', '' );
		$b_family    = get_theme_mod( 'body_font', '' );

		if ( $h_family ) {
			$font .= sprintf( "#page .u-heading {font-family: '%s';}", esc_attr( $h_family ) ); }

		if ( $b_family ) {
			$font .= sprintf( "#page .u-body,body,p {font-family: '%s';}", esc_attr( $b_family ) ); }

		// Output the styles.
		if ( $font ) {
			echo "\n" . '<style type="text/css" id="font-css">' . $font . '</style>' . "\n";
		}
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 *
	 * @return object
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

Abraham_Custom_Styles::get_instance();
