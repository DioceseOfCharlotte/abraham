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

		/* Filter the default colors late. */
		add_filter( 'theme_mod_background_color', array( $this, 'background_color_default' ), 95 );
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
	public function background_color_default( $hex ) {
		return $hex ? $hex : 'f5f5f5';
	}
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
	 * Callback for 'wp_head' that outputs the CSS for this feature.
	 *
	 * @since  1.0.0
	 */
	public function wp_head_callback() {
		$style = $this->get_primary_styles();
		$style .= $this->get_secondary_styles();
		$style .= $this->get_additional_styles();
		/* Put the final style output together. */
		$style = "\n" . '<style id="custom-colors-css">' . trim( $style ) . '</style>' . "\n";

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
		$colorDark = $primaryColor->isDark( $color300 ) ? $color600 : $color700;
		$colorLight = $primaryColor->isDark( $color300 ) ? $color100 : $color300;

		$textBase = $primaryColor->isDark( $colorBase ) ? 'fff' : '212629';
		$textOnDark = $primaryColor->isDark( $colorDark ) ? 'fff' : '212629';
		$textOnLight = $primaryColor->isDark( $colorLight ) ? 'fff' : '212629';

		$glass          = implode( ', ', hybrid_hex_to_rgb( $colorBase ) );
		$glass_dark     = implode( ', ', hybrid_hex_to_rgb( $colorDark ) );
		$glass_light    = implode( ', ', hybrid_hex_to_rgb( $colorLight ) );
		$textRGB = implode( ', ', hybrid_hex_to_rgb( $textBase ) );

		/* === Color === */

		$style .= ":root{--color-1:#{$colorBase};--color-1-light:#{$colorLight};--color-1-dark: #{$colorDark};}";
		$style .= "html .u-text-1,article.u-bg-white .u-dropcap:first-letter{color:#{$colorBase};}";
		$style .= ".u-b-1{border-color:#{$colorBase};}";
		$style .= "html .u-text-1-dark{color:#{$colorDark};}";
		$style .= ".u-b-1-dark{color:#{$colorDark};}";
		$style .= "html .u-text-1-light{color:#{$colorLight};}";
		$style .= ".u-b-1-light{border-color:#{$colorLight};}";
		$style .= "html .u-bg-1{background-color:#{$colorBase};color:#{$textBase};}";
		$style .= "html .u-bg-1-light{background-color:#{$colorLight};color:#{$textOnLight};}";
		$style .= "html .u-bg-1-dark,input[type=submit]{background-color:#{$colorDark};color:#{$textOnDark};}";
		$style .= "html .u-bg-1-glass{background-color:rgba( {$glass}, 0.98 );color:#{$textBase};}";
		$style .= "html .u-bg-1-glass-light{background-color:rgba( {$glass_light}, 0.98 );color:#{$textOnLight};}";
		$style .= "html .u-bg-1-glass-dark{background-color:rgba( {$glass_dark}, 0.98 );color:#{$textOnDark};}";
		$style .= "html .u-fill-1{fill:#{$colorBase};}";
		$style .= "html .u-fill-1-light{fill:#{$colorLight};}";
		$style .= "html .u-fill-1-dark{fill:#{$colorDark};}";

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
		$colorDark = $secondaryColor->isDark( $color300 ) ? $color600 : $color700;
		$colorLight = $secondaryColor->isDark( $color300 ) ? $color100 : $color300;

		$textBase = $secondaryColor->isDark( $colorBase ) ? 'fff' : '212629';
		$textOnDark = $secondaryColor->isDark( $colorDark ) ? 'fff' : '212629';
		$textOnLight = $secondaryColor->isDark( $colorLight ) ? 'fff' : '212629';

		$glass          = implode( ', ', hybrid_hex_to_rgb( $colorBase ) );
		$glass_dark     = implode( ', ', hybrid_hex_to_rgb( $colorDark ) );
		$glass_light    = implode( ', ', hybrid_hex_to_rgb( $colorLight ) );
		$textRGB = implode( ', ', hybrid_hex_to_rgb( $textBase ) );

		/* === Color === */

		$style .= ":root{--color-2:#{$colorBase};--color-2-light:#{$colorLight};--color-2-dark: #{$colorDark};}";
		$style .= "html .u-text-2{color:#{$colorBase};}";
		$style .= ".u-b-2{border-color:#{$colorBase};}";
		$style .= "html .u-text-2-dark{color:#{$colorDark};}";
		$style .= ".u-b-2-dark{border-color:#{$colorDark};}";
		$style .= "html .u-text-2-light{color:#{$colorLight};}";
		$style .= ".u-b-2-light{border-color:#{$colorLight};}";
		$style .= "html .u-bg-2{background-color:#{$colorBase};color:#{$textBase};}";
		$style .= "html .u-bg-2-light{background-color:#{$colorLight};color:#{$textOnLight};}";
		$style .= "html .u-bg-2-dark{background-color:#{$colorDark};color:#{$textOnDark};}";
		$style .= "html .u-bg-2-glass{background-color:rgba( {$glass}, 0.98 );color:#{$textBase};}";
		$style .= "html .u-bg-2-glass-light{background-color:rgba( {$glass_light}, 0.98 );color:#{$textOnLight};}";
		$style .= "html .u-bg-2-glass-dark{background-color:rgba( {$glass_dark}, 0.98 );color:#{$textOnDark};}";
		$style .= "html .u-fill-2{fill:#{$colorBase};}";
		$style .= "html .u-fill-2-light{fill:#{$colorLight};}";
		$style .= "html .u-fill-2-dark{fill:#{$colorDark};}";

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
	public function get_additional_styles() {
		$style = '';
		$internal_link = url_shorten( get_home_url() );

		$style .= '.entry-header a>svg>.outlink{display:none;}';
		$style .= ".entry-header a[href*='//']:not([href*='{$internal_link}'])>svg>.outlink{display:block;}";
		$style .= ".entry-header a[href*='//']:not([href*='{$internal_link}'])>svg>.inlink{display:none;}";


		/* Return the styles. */
		return str_replace( array( "\r", "\n", "\t" ), '', $style );
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
