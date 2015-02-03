<?php

//add_action( 'tha_entry_before', 'abraham_do_format_icon' );

function abraham_do_format_icon() { ?>
<span class="entry-format"><?php abe_post_format_link(); ?></span>
<?php
}
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
	get_template_part( 'partials/svg/svg', $format );
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );
	return sprintf( '<a href="%s" class="post-format-link"></a>', esc_url( $url ) );
}


/**
 * Get default footer text
 *
 * @return string $text
 */
function abraham_get_default_footer_text() {
	$text = sprintf(
		__( 'Copyright &#169; %1$s %2$s.', 'abraham' ),
	date_i18n( 'Y' ),
	hybrid_get_site_link()
	);
	$text .= '<span class="sep"> | </span>';
	$text .= sprintf(
		__( ' %s', 'abraham' ), '<a href="http://www.charlottediocese.org/" rel="designer">Diocese of Charlotte</a>' );
	return $text;
}
