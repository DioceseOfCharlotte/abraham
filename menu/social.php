<?php if ( ! has_nav_menu( 'social' ) ) {
  return;
}
?>

	<?php wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu menu-social',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu__items--social',
			'depth'           => 1,
			'link_before'     => '<span class="visuallyhidden">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	); ?>
