<?php
/**
 * Secondary Menu.
 *
 * @package Abraham
 */

if ( ! has_nav_menu( 'secondary' ) ) {
	return;
}
?>

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>
		<button class="menu-toggle u-f1 u-bg-frost-1 u-1of1" aria-controls="menu-secondary-items" aria-expanded="false"><?php esc_html_e( 'Menu', '_s' ); ?><?php abe_do_svg( 'chevron-down', 'sm' ); ?></button>
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items nav-menu u-f-minus u-flex u-flex-wrap u-flex-jc',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>',
			)
		); ?>

	</nav><!-- #menu-secondary -->
