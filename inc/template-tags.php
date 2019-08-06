<?php
/**
 * Custom template tags.
 *
 * @package Abraham
 */

use Mexitek\PHPColors\Color;

/**
 * Display the SVG.
 *
 * @param string $icon name of the icon.
 * @param string $size css class for icon size.
 */
function abe_do_svg( $icon = 'info', $height = '1em', $width = '' ) {
		echo abe_get_svg( $icon, $height, $width );
}

/**
 * Get the SVG.
 *
 * @param string $icon name of the icon.
 * @param string $size css class for icon size.
 */
function abe_get_svg( $icon = 'info', $height = '1em', $width = '', $is_info = false ) {

	// Set ARIA.
	$aria_label  = ' role="img" aria-label="' . esc_html( $icon ) . '"';
	$aria_hidden = ' aria-hidden="true"';

	if ( $height == 'sm' ) {
		$height = '1em';
	}

	if ( $width == '' ) {
		$width = $height;
	}

	$is_info = $is_info ? $aria_label : $aria_hidden;

	// Begin SVG markup
	$svg = file_get_contents( locate_template( 'images/icons/' . esc_html( $icon ) . '.svg' ) );

	$svg = str_replace( '<svg', '<svg focusable="false" class="doc-icon doc-icon-' . $icon . '" height="' . $height . '" width="' . $width . '"' . $is_info, $svg );

	return $svg;
}

/**
 * Display an SVG.
 *
 * @param  array  $args  Parameters needed to display an SVG.
 */


/**
 * Display the Edit Post Link
 */
function abe_edit_link() {
	return edit_post_link( abe_get_svg( 'edit', '1em', '1em', true ) . '<span class="screen-reader-text">Edit ' . get_the_title( get_the_ID() ) . '</span>' );
}


/**
 * Echo the copyright text saved in the Customizer.
 */
function abe_do_copyright_text() {
	// Grab our customizer settings.
	$copyright_text = get_theme_mod( 'abe_copyright_text' );
	// Display the default text.
	if ( ! $copyright_text ) {
		return printf( __( '&#169; %1$s %2$s', 'abraham' ), date_i18n( 'Y' ), hybrid_get_site_link() );
	}
	// Display the customizer text.
	return printf( __( '&#169; %1$s %2$s', 'abraham' ), date_i18n( 'Y' ), wp_kses_post( $copyright_text ) );
}

/**
 * Colors
 */
function doc_prime_style( $alpha ) {
	$style  = '';
	$style .= 'background-color:';
	$style .= doc_prime_rgb( $alpha );
	$style .= ';color:';
	$style .= doc_prime_text();
	$style .= ';';
	return $style;
}

function doc_prime_hex() {
	$prime     = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
	$hex_color = $prime ? trim( $prime, '#' ) : get_theme_mod( 'primary_color', '' );
	return "#{$hex_color}";
}

function doc_prime_rgb( $alpha = '1' ) {
	$doc_hex = doc_prime_hex();
	$doc_rgb = implode( ',', hybrid_hex_to_rgb( $doc_hex ) );
	return 'rgba(' . $doc_rgb . ',' . $alpha . ')';
}

function doc_prime_text() {
	$prime      = new Color( doc_prime_hex() );
	$text_color = $prime->isDark() ? 'fff' : '333';
	return "#{$text_color}";
}

function abe_second_style( $alpha ) {
	$style .= 'background-color:';
	$style .= abe_second_rgb( $alpha );
	$style .= ';color:';
	$style .= abe_second_text();
	$style .= ';';
	return $style;
}

function abe_second_hex() {
	$second    = get_post_meta( get_the_ID(), 'doc_page_secondary_color', true );
	$hex_color = $second ? trim( $second, '#' ) : get_theme_mod( 'secondary_color', '' );
	return "#{$hex_color}";
}

function abe_second_rgb( $alpha = '1' ) {
	$abe_hex = abe_second_hex();
	$abe_rgb = implode( ',', hybrid_hex_to_rgb( $abe_hex ) );
	return 'rgba(' . $abe_rgb . ',' . $alpha . ')';
}

function abe_second_text() {
	$second     = new Color( abe_second_hex() );
	$text_color = $second->isDark() ? 'fff' : '333';
	return "#{$text_color}";
}

// Layout helpers.
function abe_is_wide_layout() {

	return abe_has_layout( 'blank-canvas' ) || abe_has_layout( '1-column-wide' );
}

function abe_has_layout( $layout ) {

	return $layout === hybrid_get_theme_layout( 'theme_layout' );
}

function abe_hint( $text, $position = 0 ) {
	$position = $position ? "hint--{$position}" : 'hint--top-left';
	$tooltip  = '<span class="abe-tip ' . $position . '" aria-label="' . $text . '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 16h-2v-2h2v2zm0-4.14V15h-2v-2c0-.552.448-1 1-1 1.103 0 2-.897 2-2s-.897-2-2-2-2 .897-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 1.862-1.278 3.413-3 3.86z"/></svg></span>';

	return $tooltip;
}

/**
 * Semantic <sidebar> hooks
 */

function abe_sidenav_before() {
	do_action( 'abe_sidenav_before' );
}

function abe_sidenav_after() {
	do_action( 'abe_sidenav_after' );
}
