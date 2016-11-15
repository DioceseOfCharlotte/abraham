<?php
/**
 * Primary Menu.
 *
 * @package Abraham
 */

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}
?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
		<button class="menu-toggle u-f1 u-bg-frost-1 u-1of1" aria-controls="menu-primary-items" aria-expanded="false"><?php esc_html_e( 'Menu', '_s' ); ?><?php abe_do_svg( 'chevron-down', 'sm' ); ?></button>
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items nav-menu u-f-minus',
				'fallback_cb'     => '',
				'items_wrap'      => '<div class="menu-main-container u-bg-tint-1"><ul id="%s" class="%s">%s</ul></div>'
			)
		); ?>

	</nav><!-- #menu-primary -->
