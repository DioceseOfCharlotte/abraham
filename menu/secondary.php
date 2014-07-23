<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

<nav class="navdrawer-container promote-layer" role="navigation" aria-label="Secondary Menu" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

		<h4 class="menu-header">
		<?php
				/* Translators: %s is the nav menu name. This is the nav menu title shown to screen readers. */
				printf( _x( '%s Menu', 'nav menu title', 'stargazer' ), hybrid_get_menu_location_name( 'secondary' ) ); 
			?>
		</h4><!-- .menu-toggle -->

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

	</nav><!-- #menu-secondary -->

<?php endif; // End check for menu. ?>