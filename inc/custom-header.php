<?php
/**
 * @package Scratch
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses scratch_header_style()
 * @uses scratch_admin_header_style()
 * @uses scratch_admin_header_image()
 */

/* Call late so child themes can override. */
add_action( 'after_setup_theme', 'scratch_custom_header_setup', 15 );

/**
 * Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function scratch_custom_header_setup() {

	/* Adds support for WordPress' "custom-header" feature. */
	add_theme_support(
		'custom-header',
		array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 1220,
			'height'                 => 400,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => 'fafafa',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => 'scratch_custom_header_wp_head',
			'admin-head-callback'    => 'scratch_custom_header_admin_head',
			'admin-preview-callback' => 'scratch_custom_header_admin_preview',
		)
	);

	/* Registers default headers for the theme. */
	//register_default_headers();
}

/**
 * Callback function for outputting the custom header CSS to `wp_head`.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */


function scratch_custom_header_wp_head() {

	if ( !display_header_text() )
		return;

	$hex = get_header_textcolor();
	if ( empty( $hex ) )
		return;

	$style = '';

	$rgb = hybrid_hex_to_rgb( $hex );

	$style .= "#site-title, #site-title a, #footer a { color: #{$hex} }";

	$style .= "#site-description, #footer { color: rgba( {$rgb['r']}, {$rgb['g']}, {$rgb['b']}, 0.75 ); }";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}



/**
 * Callback for the admin preview output on the "Appearance > Custom Header" screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function scratch_custom_header_admin_preview() { ?>

		<div <?php hybrid_attr( 'body' ); // Fake <body> class. ?>>

			<header <?php hybrid_attr( 'header' ); ?>>

				<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

					<div id="branding">
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->

				<?php endif; // End check for header text. ?>

			</header><!-- #header -->

			<?php if ( get_header_image() && !display_header_text() ) : // If there's a header image but no header text. ?>

				<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>

			<?php elseif ( get_header_image() ) : // If there's a header image. ?>

				<img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />

			<?php endif; // End check for header image. ?>

		</div><!-- Fake </body> close. -->

<?php }
/**
 * Callback function for outputting the custom header CSS to `admin_head` on "Appearance > Custom Header".  See 
 * the `css/admin-custom-header.css` file for all the style rules specific to this screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function scratch_custom_header_admin_head() {
	if ( !display_header_text() )
		return;
	$hex = get_header_textcolor();
	if ( empty( $hex ) )
		return;
	$rgb = hybrid_hex_to_rgb( $hex );
	$style = "#site-title, #site-title a { color: #{$hex} }";
	$style .= "#site-description { color: rgba( {$rgb['r']}, {$rgb['g']}, {$rgb['b']}, 0.75 ); }";
	/* Get the background color. */
	$color = get_background_color();
	if ( !empty( $color ) )
		$style .= "div.wordpress{ background: #{$color}; }";
	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}