<?php
use Mexitek\PHPColors\Color;

function abe_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}


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
function abe_get_featured_posts() {
	return apply_filters( 'abe_get_featured_posts', false );
}

/**
 * SVG
 */
function abe_do_svg( $icon='cog', $size='sm' ) { ?>
<div class="icon-<?= $size ?>">
	<?php include( locate_template( 'images/icons/'.esc_attr( $icon ).'.svg' ) ); ?>
</div>
<?php }

/**
 * Colors
 */

 function doc_prime_style($alpha) {
	 $style = 'style="';
	 $alpha = $alpha ? $alpha : '1';
	 $style .= 'background-color:';
	 $style .= doc_prime_rgb($alpha);
	 $style .= ';color:';
	 $style .= doc_prime_text();
	 $style .= ';"';
 	return $style;
 }

 function doc_prime_hex() {
	 $prime = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
	 return $prime ? $prime : get_theme_mod('primary_color', '');
 }

function doc_prime_rgb($alpha) {
	$doc_hex = doc_prime_hex();
	$doc_rgb = implode( ',', hybrid_hex_to_rgb( $doc_hex ) );

	return 'rgba('. $doc_rgb .','. $alpha .')';
}

function doc_prime_text() {
	$prime = new Color(doc_prime_hex());

	return $prime->isDark() ? "#EEE":"#333";
}
