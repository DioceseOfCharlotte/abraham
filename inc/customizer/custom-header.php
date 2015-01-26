<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Abraham
 */

/* Call late so child themes can override. */
add_action( 'after_setup_theme', 'abraham_custom_header_setup', 15 );

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses abraham_header_style()
 * @uses abraham_admin_header_style()
 * @uses abraham_admin_header_image()
 */
function abraham_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'abraham_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '212121',
		'width'                  => 1200,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'abraham_header_style'
	) ) );
}

if ( ! function_exists( 'abraham_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see abraham_custom_header_setup().
 */
function abraham_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title,
		#site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // abraham_header_style
