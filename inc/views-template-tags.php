<?php
use Mexitek\PHPColors\Color;

/**
 * Logo
 */
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
function abe_do_svg( $icon='cog', $size='sm' ) {
    echo abe_get_svg( $icon='cog', $size='sm' );
}

function abe_get_svg( $icon='cog', $size='sm' ) {
    
ob_start(); ?>

<div class="icon-<?= $size ?>">
	<?php include( locate_template( 'images/icons/'.esc_attr( $icon ).'.svg' ) ); ?>
</div>

<?php return ob_get_clean();

}



/**
 *
 */
function abe_edit_link() {
    edit_post_link(abe_get_svg( 'compose', 'sm' ));
}
add_action( 'tha_entry_bottom', 'abe_edit_link' );

function meh_edit_post_link($output) {
    $output = str_replace('class="post-edit-link"', 'class="post-edit-link btn btn-round u-abs u-right0 u-bottom0"', $output);
    return $output;
}
add_filter('edit_post_link', 'meh_edit_post_link');



/**
 * Colors
 */
 function doc_prime_style($alpha='1') {
	 $style .= 'background-color:';
	 $style .= doc_prime_rgb($alpha);
	 $style .= ';color:';
	 $style .= doc_prime_text();
	 $style .= ';';
 	return $style;
 }

 function doc_prime_hex() {
	 $prime = get_post_meta( get_the_ID(), 'doc_page_primary_color', true );
	 $hex_color = $prime ? trim( $prime, '#' ) : get_theme_mod('primary_color', '');
	 return "#{$hex_color}";
 }

function doc_prime_rgb($alpha) {
	$doc_hex = doc_prime_hex();
	$doc_rgb = implode( ',', hybrid_hex_to_rgb( $doc_hex ) );
	return 'rgba('. $doc_rgb .','. $alpha .')';
}

function doc_prime_text() {
	$prime = new Color(doc_prime_hex());
	$text_color = $prime->isDark() ? "fff":"333";
	return "#{$text_color}";
}

function abe_second_style($alpha='1') {
	$style .= 'background-color:';
	$style .= abe_second_rgb($alpha);
	$style .= ';color:';
	$style .= abe_second_text();
	$style .= ';';
   return $style;
}

function abe_second_hex() {
	$second = get_post_meta( get_the_ID(), 'doc_page_secondary_color', true );
	$hex_color = $second ? trim( $second, '#' ) : get_theme_mod('secondary_color', '');
	return "#{$hex_color}";
}

function abe_second_rgb($alpha) {
   $abe_hex = abe_second_hex();
   $abe_rgb = implode( ',', hybrid_hex_to_rgb( $abe_hex ) );
   return 'rgba('. $abe_rgb .','. $alpha .')';
}

function abe_second_text() {
   $second = new Color(abe_second_hex());
   $text_color = $second->isDark() ? "fff":"333";
   return "#{$text_color}";
}
