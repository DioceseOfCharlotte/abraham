<?php
/**
 * Custom template tags.
 *
 * @package Abraham
 */

use Mexitek\PHPColors\Color;

/**
 * Featured Posts
 */
function abe_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'abe_get_featured_posts', array() );
	if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
		return true;
	}
	return false;
}

/**
 * Display the SVG.
 *
 * @param string $icon name of the icon.
 * @param string $size css class for icon size.
 */
function abe_do_svg( $icon, $size ) {
	echo abe_get_svg( $icon, $size );
}

/**
 * Get the SVG.
 *
 * @param string $icon name of the icon.
 * @param string $size css class for icon size.
 */
function abe_get_svg( $icon = 'info', $size = 'sm' ) {

	ob_start(); ?>
	<span class="icon-<?= $size ?>"><?php include( locate_template( 'images/icons/'.esc_attr( $icon ).'.svg' ) ); ?></span>
	<?php return ob_get_clean();

}

/**
 * Display the Edit Post Link
 */
function abe_do_edit_link() {
	edit_post_link( abe_get_svg( 'edit', 'sm' ) );
}
add_action( 'tha_entry_bottom', 'abe_do_edit_link' );

/**
 * Customize the html of the edit link
 *
 * @param string $output Link html.
 */
function meh_edit_post_link( $output ) {
	$output = str_replace( 'class="post-edit-link"', 'class="post-edit-link btn u-z2 btn-round u-opacity u-abs u-right0 u-bottom0"', $output );
	return $output;
}
add_filter( 'edit_post_link', 'meh_edit_post_link' );


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
	$style = '';
	$style .= 'background-color:';
	$style .= doc_prime_rgb( $alpha );
	$style .= ';color:';
	$style .= doc_prime_text();
	$style .= ';';
	return $style;
}

function doc_prime_hex() {
	$prime = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
	$hex_color = $prime ? trim( $prime, '#' ) : get_theme_mod( 'primary_color', '' );
	return "#{$hex_color}";
}

function doc_prime_rgb( $alpha = '1' ) {
	$doc_hex = doc_prime_hex();
	$doc_rgb = implode( ',', hybrid_hex_to_rgb( $doc_hex ) );
	return 'rgba('. $doc_rgb .','. $alpha .')';
}

function doc_prime_text() {
	$prime = new Color( doc_prime_hex() );
	$text_color = $prime->isDark() ? 'fff':'333';
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
	$second = get_post_meta( get_the_ID(), 'doc_page_secondary_color', true );
	$hex_color = $second ? trim( $second, '#' ) : get_theme_mod( 'secondary_color', '' );
	return "#{$hex_color}";
}

function abe_second_rgb( $alpha = '1' ) {
	$abe_hex = abe_second_hex();
	$abe_rgb = implode( ',', hybrid_hex_to_rgb( $abe_hex ) );
	return 'rgba('. $abe_rgb .','. $alpha .')';
}

function abe_second_text() {
	$second = new Color( abe_second_hex() );
	$text_color = $second->isDark() ? 'fff':'333';
	return "#{$text_color}";
}
