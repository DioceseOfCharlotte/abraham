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
<aside class="js-off-canvas off-canvas u-z4 u-fix u-left0 u-top0 u-1of1 u-height100 if-admin-bar u-overflow-hidden">
	<nav class="js-off-canvas-container off-canvas__container u-rel u-bg-white u-height100 u-flex u-flex-col u-shadow3">

		<button class="js-menu-hide off-canvas__hide u-abs u-z1 u-bg-frost-3 btn-round u-top0 u-left0 u-m2">
			<?php abe_do_svg( 'close', 'sm' ); ?>
		</button>

		<header class="off-canvas__header u-flex u-flex-end u-p2 u-h3 u-bg-2 u-shadow1"><?php bloginfo( 'name' ); ?></header>

    <ul class="off-canvas__content u-py2 u-flexed-1 ">
      <?php dynamic_sidebar( 'secondary' ); ?>
    </ul>

	</nav>
</aside>
