<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>
	
	<nav class="navdrawer-container" <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<div class="menu-header"></div><!-- breadcrumb container -->

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul></div>'
			)
		); ?>
<?php get_search_form(); ?>
	</nav><!-- #menu-primary -->

<?php endif; // End check for menu. ?>