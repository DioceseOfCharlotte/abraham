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



		<header class="side-nav__header u-flex u-flex-wrap u-bg-2-light u-shadow1">
			<div class="side-nav__title u-1of1 u-flex u-bg-2 u-flex-center u-p1 u-mb1">
				<button class="js-menu-hide side-nav__hide u-z1 btn-round u-h3 u-inline-flex">
					<?php abe_do_svg( 'arrow-left', 'sm' ); ?>
				</button>
				<h2 class="u-h4 u-m0 u-text-display u-inline-block u-flexed-auto u-text-center"><a class="opacity-hover" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			</div>
			<?php get_search_form(); ?>
		</header>

    <div class="side-nav__content u-py2 u-flexed-1 ">
		<?php dynamic_sidebar( 'secondary' ); ?>
	</div>

	</nav>
</aside>
