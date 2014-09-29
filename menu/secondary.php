<?php if ( ! has_nav_menu( 'secondary' ) ) {
  return;
}
?>

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items grid',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

	</nav><!-- #menu-secondary -->
