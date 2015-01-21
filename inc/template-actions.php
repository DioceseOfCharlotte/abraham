<?php

//add_action( 'tha_entry_bottom', 'abraham_do_format_icon' );

/**
 * Filter the abe_post_format_link to remove the text
 */
function abraham_post_format_link() {
	echo abraham_get_post_format_link();
}

function abraham_get_post_format_link() {

	$format = get_post_format();
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );

	return sprintf(
	  '<a href="%s" class="post-format-link">
	    <span class="%s format-icon">',
	      esc_url( $url ), get_post_format_string( $format )
	);
}

if ( ! function_exists( 'abraham_format_svg' ) ) :
function abraham_format_svg() {
$format = get_post_format();
get_template_part( 'images/svg/svg', $format );
}
endif; // End check.


function abraham_do_format_icon() {

	abraham_post_format_link(); ?>
	<span class="format-icon--wrap"><?php abraham_format_svg(); ?></span>
	</span></a>
	<?php
}










/**
 * Outputs a link to the post format archive.
 *
 * @since  2.0.0
 * @access public
 * @return void
 */
function abe_post_format_link() {
	echo abe_get_post_format_link();
}
/**
 * Generates a link to the current post format's archive.  If the post doesn't have a post format, the link
 * will go to the post permalink.
 *
 * @since  2.0.0
 * @access public
 * @return string
 */
function abe_get_post_format_link() {
	$format = get_post_format();
	get_template_part( 'images/svg/svg', $format );
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );
	return sprintf( '<a href="%s" class="post-format-link"></a>', esc_url( $url ) );
}
