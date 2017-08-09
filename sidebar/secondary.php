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

		<header class="side-nav__header u-flex u-flex-wrap u-bg-2 u-p1 u-shadow1">

			<div class="side-nav__close-button u-pr">
				<button class="js-menu-hide side-nav__hide u-z1 btn-round u-bg-2-light u-h3 u-inline-flex">
					<?php abe_do_svg( 'arrow-left', 'sm' ); ?>
				</button>

			</div>

			<?php get_template_part( 'components/sidenav-header' ); ?>

		</header>

		<div class="side-nav__content u-py2 u-flexed-1 ">
			<?php abe_sidenav_before() ?>
			<?php dynamic_sidebar( 'secondary' ); ?>
			<?php abe_sidenav_after() ?>
		</div>

	</nav>
</aside>
