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



		<header class="off-canvas__header u-flex u-flex-wrap u-bg-2 u-shadow1">
			<div class="off-canvas__title u-1of1 u-flex u-flex-center u-px1 u-py2">
				<button class="js-menu-hide off-canvas__hide u-z1 btn-round u-h3 u-inline-flex">
					<?php abe_do_svg( 'arrow-left', 'sm' ); ?>
				</button>
				<h2 class="u-h3 u-m0 u-text-display u-inline-block u-flexed-auto u-text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			</div>
			<?php get_search_form(); ?>
		</header>

    <div class="off-canvas__content u-py2 u-flexed-1 ">
		<?php dynamic_sidebar( 'secondary' ); ?>
  </div>

	</nav>
</aside>
