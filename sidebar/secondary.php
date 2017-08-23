<?php
/**
 * Sidebar Secondary Template.
 *
 * @package Abraham
 */

if ( ! is_active_sidebar( 'secondary' ) ) {
	return;
}
?>
<aside class="js-side-nav side-nav u-fix u-left0 u-top0 u-1of1 u-height100 if-admin-bar u-overflow-hidden">
	<nav class="js-side-nav-container side-nav__container u-rel u-bg-white u-height100 u-flex u-flex-col u-shadow3">

		<div class="sidebar-actions u-rel u-flex u-f1 u-p05 u-shadow1 u-bg-2-light">
			<button class="js-menu-hide side-nav__hide u-z1 u-top0 u-left0">
				<?php abe_do_svg( 'close', '1em' ); ?>
			</button>
			<?php get_search_form() ?>
		</div>

		<div class="side-nav__content u-py2 u-flexed-1 ">

			<?php abe_sidenav_before() ?>
			<?php dynamic_sidebar( 'secondary' ); ?>
			<?php abe_sidenav_after() ?>

		</div>

	</nav>
</aside>
