<?php
/**
 * Header Right Sidebar Template
 *
 * @package     Compass
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2014, Flagship, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */
add_filter( 'wp_nav_menu_args', 'flagship_widget_menu_args' );
add_filter( 'wp_nav_menu', 'flagship_header_menu_wrap' );

if ( is_active_sidebar( 'header-right' ) ) : ?>

	<div <?php hybrid_attr( 'header-right' ); ?>>

		<?php dynamic_sidebar( 'header-right' ); ?>

	</div><!-- .header-right -->

	<?php

endif;

// Add a notice about the widget area for logged-in users if no widgets are added.
if ( ! is_active_sidebar( 'header-right' ) && current_user_can( 'edit_theme_options' ) ) :

	?>
	<div <?php hybrid_attr( 'header-right' ); ?>>

		<p class="no-menu">
			<?php _e( 'This is a widget area! It\'s perfect for a custom menu.', 'compass' ); ?>

			<?php
			printf( '<a class="button" href="%s">%s</a>',
				esc_url( admin_url( 'customize.php' ) ),
				__( 'Customize Now', 'compass' )
			);
			?>
		</p>

	</div><!-- .header-right -->

	<?php

endif;

remove_filter( 'wp_nav_menu_args', 'flagship_widget_menu_args' );
remove_filter( 'wp_nav_menu', 'flagship_header_menu_wrap' );
