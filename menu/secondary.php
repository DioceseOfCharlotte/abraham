<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

<nav class="navdrawer-container promote-layer" role="navigation" aria-label="Secondary Menu" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

		<div class="menu-header"></div><!-- breadcrumb container -->

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