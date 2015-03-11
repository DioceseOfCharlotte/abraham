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
	return $text;
}














add_filter( 'tiny_mce_before_init', 'abraham_tiny_mce_formats', 99 );
/**
 * Add our custom styles to the Flagship styleselect dropdown button.
 *
 * @since  0.2.0
 * @access public
 * @param  $args array existing TinyMCE arguments
 * @return $args array modified TinyMCE arguments
 * @see    http://wordpress.stackexchange.com/a/128950/9844
 */
function abraham_tiny_mce_formats( $args ) {
	$abraham_formats = apply_filters( 'abraham_tiny_mce_formats',
		array(
			array(
				'title'    => __( 'Icon Buttons', 'abraham-library' ),
				'items'    => array(
					array(
						'title'    => __( 'Download', 'abraham-library' ),
						'selector' => 'a',
						'classes'  => 'button button--download',
						'exact'    => true,
					),
					array(
						'title'    => __( 'Information', 'abraham-library' ),
						'selector' => 'a',
						'classes'  => 'button button--info',
						'exact'    => true,
					),
					array(
						'title'    => __( 'External Link', 'abraham-library' ),
						'selector' => 'a',
						'classes'  => 'button button--link-ext',
						'exact'    => true,
					),
					array(
						'title'    => __( 'Donate', 'abraham-library' ),
						'selector' => 'a',
						'classes'  => 'button button--donate',
						'exact'    => true,
					),
				),
			),
			array(
				'title'    => __( 'Alert', 'abraham-library' ),
				'items'    => array(
				array(
					'title'    => __( 'Information', 'abraham-library' ),
					'block'    => 'div',
					'classes'  => 'panel panel--info',
					'wrapper'  => true,
					'exact'    => true,
				),
				array(
					'title'    => __( 'Warning', 'abraham-library' ),
					'block'    => 'div',
					'classes'  => 'panel panel--warning',
					'wrapper'  => true,
					'exact'    => true,
				),
				array(
					'title'    => __( 'Important', 'abraham-library' ),
					'block'    => 'div',
					'classes'  => 'panel panel--important',
					'wrapper'  => true,
					'exact'    => true,
				),
				),
			),
			array(
				'title'    => __( 'Citation', 'abraham-library' ),
				'block'    => 'cite',
				'classes'  => 'cite',
			),
			array(
				'title'    => __( 'Text Highlight', 'abraham-library' ),
				'inline' => 'span',
				'classes'  => 'text-highlight',
				'exact'    => true,
			),
			array(
				'title'    => __( 'Text Grey', 'abraham-library' ),
				'inline' => 'span',
				'classes'  => 'text-grey',
				'exact'    => true,
			),
		)
	);
	// Merge with any existing formats which have been added by plugins.
	if ( ! empty( $args['style_formats'] ) ) {
		$existing_formats = json_decode( $args['style_formats'] );
		$abraham_formats = array_merge( $abraham_formats, $existing_formats );
	}
	$args['style_formats'] = json_encode( $abraham_formats );
	return $args;
}
