<?php
/**
 * @package Abraham
 */

if ( has_nav_menu( 'primary' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-list',
				'menu_class'      => 'menu-primary__list nav-menu',
				'depth'           => 2,
				'fallback_cb'     => ''
			)
		); ?>

	</nav>

<?php
endif;
