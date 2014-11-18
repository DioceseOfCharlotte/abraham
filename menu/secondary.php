<?php if ( has_nav_menu( 'secondary' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>

		<h3 id="menu-secondary-title" class="menu-toggle">
			<button class="screen-reader-text"><?php
				/* Translators: %s is the nav menu name. This is the nav menu title shown to screen readers. */
				printf( _x( '%s Menu', 'nav menu title', 'abraham' ), hybrid_get_menu_location_name( 'secondary' ) );
			?></button>
		</h3><!-- .menu-toggle -->

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<div class="wrap menu__secondary-wrap"><ul id="%s" class="%s">%s</ul></div>'
			)
		); ?>

	</nav><!-- #menu-secondary -->

<?php endif; // End check for menu. ?>