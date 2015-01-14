<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu__primary--items nav-menu',
				'fallback_cb'     => ''
			)
		); ?>

	</nav><!-- #site-navigation -->

<?php endif; // End check for menu. ?>
