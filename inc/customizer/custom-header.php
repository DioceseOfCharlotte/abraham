<?php
/**
* Handles the setup and usage of the WordPress custom headers feature.
*
* @package    Abraham
*/

// Call late so child themes can override.
add_action( 'after_setup_theme', 'abraham_custom_header_setup', 15 );

/**
* Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
*
* @since  1.0.0
* @access public
* @return void
*/
function abraham_custom_header_setup() {

	// Adds support for WordPress' "custom-header" feature.
	add_theme_support( 'custom-header',
		array(
			'width'                  => 2000,
			'height'                 => 1200,
			'flex-height'            => true,
			'default-text-color'     => 'ffffff',
			'video' 				=> true,
			'video-active-callback' => 'is_front_page',
			'wp-head-callback'       => 'abraham_header_style',
		)
	);
}

/**
* Callback function for outputting the custom header CSS to `wp_head`.
*
* @since  1.0.0
* @access public
* @return void
*/
if ( ! function_exists( 'abraham_header_style' ) ) :

	function abraham_header_style() {
		$header_text_color = get_header_textcolor();
		$bg_color = get_theme_mod( 'background_color', 'F7EDE7' );
		$bg_rgb = join( ', ', hybrid_hex_to_rgb( $bg_color ) );

		// Has the text been hidden?
		if ( ! display_header_text() ) :
			$style = "
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}";
			// If the user has set a custom color for the text use that.
		else :
			$style = "
			.home .site-header.is-top > * {
				color: #{$header_text_color};
			}";
		endif;

			$style .= "
			.site {
				position: relative;
				background-image: linear-gradient(to bottom, rgba( {$bg_rgb}, 0.0) 0, rgba( {$bg_rgb}, 0.3) 40vh, rgba( {$bg_rgb}, 0.85) 99vh, rgba( {$bg_rgb}, .99) 100%);
				background-image: var(--site-bg);
			}
			";

			echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
		}
	endif; // End of abraham_header_style.

	if ( ! function_exists( 'abe_custom_header_image' ) ) :

		function abe_custom_header_image( $size = 'large' ) {
			$post_id = get_the_ID();
			if ( has_post_thumbnail( $post_id ) && is_singular() ) {
				return get_the_post_thumbnail_url( $post_id, $size );
			} else {
				return get_header_image();
			}
			return;
		}

	endif; // End of abe_custom_header_image.
