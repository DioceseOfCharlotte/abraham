<?php
/**
 * Handles the setup and usage of the WordPress custom headers feature.
 *
 * @package    Abraham
 */

/* Call late so child themes can override. */
add_action( 'after_setup_theme', 'abraham_custom_header_setup', 15 );

/**
 * Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_custom_header_setup() {

	/* Adds support for WordPress' "custom-header" feature. */
	add_theme_support(
		'custom-header',
		array(
			'default-image'          => '%s/images/headers/orange-burn.jpg',
			'random-default'         => false,
			'width'                  => 1175,
			'height'                 => 400,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => '4e5758',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => 'abraham_custom_header_wp_head',
			'admin-head-callback'    => 'abraham_custom_header_admin_head',
			'admin-preview-callback' => 'abraham_custom_header_admin_preview',
		)
	);

	/* Registers default headers for the theme. */
	register_default_headers(
		array(
			'window' => array(
				'url'           => '%s/images/headers/doc-window.jpg',
				'thumbnail_url' => '%s/images/headers/doc-window-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Window', 'abraham' )
			),
			'orange-burn' => array(
				'url'           => '%s/images/headers/doc-inside.jpg',
				'thumbnail_url' => '%s/images/headers/doc-inside-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Orange Burn', 'abraham' )
			),
			'planets-blue' => array(
				'url'           => '%s/images/headers/planets-blue.jpg',
				'thumbnail_url' => '%s/images/headers/planets-blue-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Blue Planets', 'abraham' )
			),
			'planet-burst' => array(
				'url'           => '%s/images/headers/planet-burst.jpg',
				'thumbnail_url' => '%s/images/headers/planet-burst-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Planet Burst', 'abraham' )
			),
			'space-splatters' => array(
				'url'           => '%s/images/headers/space-splatters.jpg',
				'thumbnail_url' => '%s/images/headers/space-splatters-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Space Splatters', 'abraham' )
			),
		)
	);

	/* Load the stylesheet for the custom header screen. */
	add_action( 'admin_enqueue_scripts', 'abraham_enqueue_admin_custom_header_styles', 5 );
}

/**
 * Enqueues the styles for the "Appearance > Custom Header" screen in the admin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_enqueue_admin_custom_header_styles( $hook_suffix ) {

	if ( 'appearance_page_custom-header' === $hook_suffix ) {
		wp_enqueue_style( 'abraham-fonts' );
		wp_enqueue_style( 'abraham-admin-custom-header' );

		if ( is_child_theme() ) {
			$dir = trailingslashit( get_stylesheet_directory() );
			$uri = trailingslashit( get_stylesheet_directory_uri() );

			if ( file_exists( $dir . 'css/admin-custom-header.css' ) )
				wp_enqueue_style( get_stylesheet() . '-admin-custom-header', "{$uri}css/admin-custom-header.css" );
		}
	}
}

/**
 * Callback function for outputting the custom header CSS to `wp_head`.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_custom_header_wp_head() {

	if ( !display_header_text() )
		return;

	$hex = get_header_textcolor();

	if ( empty( $hex ) )
		return;

	$style = "body.custom-header #site-title a, #site-description { color: #{$hex}; }";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}

/**
 * Callback for the admin preview output on the "Appearance > Custom Header" screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function abraham_custom_header_admin_preview() { ?>

		<div <?php hybrid_attr( 'body' ); // Fake <body> class. ?>>

			<header <?php hybrid_attr( 'header' ); ?>>

				<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

										<div <?php hybrid_attr( 'branding' ); ?>>

						<?php if ( get_theme_mod( 'logo', false ) ) {
								echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo" rel="home"><img src="' . esc_url( get_theme_mod( 'logo' ) ) . '"></a>';
						}?>
						<div class="title-wrap">
							<?php hybrid_site_title(); ?>
							<?php hybrid_site_description(); ?>
						</div>
					</div><!-- #branding -->

				<?php endif; // End check for header text. ?>

				<?php hybrid_get_menu( 'secondary' ); ?>

			</header><!-- #header -->

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
function abraham_custom_header_admin_head() {

	$hex = get_header_textcolor();

	if ( empty( $hex ) )
		return;

	$style = "#site-title a { color: #{$hex}; }";

	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}
