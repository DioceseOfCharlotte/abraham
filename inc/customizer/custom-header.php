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
				background-image: linear-gradient(to bottom, rgba( {$bg_rgb}, 0.0) 0, rgba( {$bg_rgb}, 0.3) 40vh, rgba( {$bg_rgb}, 0.7) 80vh, rgba( {$bg_rgb}, 0.9) 95vh, rgba( {$bg_rgb}, 0.99) 99vh);
			}
			";

			echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
		}
	endif; // End of abraham_header_style.

	if ( ! function_exists( 'abe_custom_header_image' ) ) :

		function abe_custom_header_image( $size = 'large' ) {
			$bg_image = '';

			$queried_object_id = get_queried_object_id();
			$post_image = get_post_meta( $queried_object_id, 'header_image', true );

			$term_image = get_term_meta( $queried_object_id, 'image', true );

			if ( $post_image ) {
				$bg_image = wp_get_attachment_image_url( $post_image, 'abe-hd-lg' );

			} elseif ( has_post_thumbnail() ) {
				$bg_image = wp_get_attachment_image_url( get_post_thumbnail_id(), 'abe-hd-lg' );

			} elseif ( get_header_image() ) {
				$bg_image = get_header_image();
			}
			if ( $bg_image ) {
				return $bg_image;
			}
		}

	endif; // End of abe_custom_header_image.
