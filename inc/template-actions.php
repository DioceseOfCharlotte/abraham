<?php

//add_action( 'tha_entry_bottom', 'abraham_do_format_icon' );

/**
 * Outputs an svg link to the post format archive.
 *
 * @since  1.0.0
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
 * @since  1.0.0
 * @access public
 * @return string
 */
function abe_get_post_format_link() {
	$format = get_post_format();
	get_template_part( 'images/svg/svg', $format );
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );
	return sprintf( '<a href="%s" class="post-format-link"></a>', esc_url( $url ) );
}
