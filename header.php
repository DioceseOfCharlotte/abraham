<?php
/**
 * Site Header template.
 *
 * @package Abraham
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr( 'head' ); ?>>
	<?php wp_head(); ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<?php tha_body_top(); ?>

	<div <?php hybrid_attr( 'site_container' ); ?>>

		<div class="top-header u-px2 u-flex u-flex-center u-bg-1-dark u-1of1 u-shadow1">
		  <button class="js-menu-show header__menu-toggle btn-round u-z2 icon-account"></button>
		</div>

		<?php tha_header_before(); ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php tha_header_top(); ?>

			<?php get_template_part( 'components/site', 'branding' ); ?>

			<?php tha_header_bottom(); ?>

		</header>

		<?php tha_header_after(); ?>

		<aside class="js-side-nav slide-nav u-fix u-left0 u-top0 u-1of1 u-height100 u-overflow-hidden">
		  <nav class="js-side-nav-container slide-nav__container u-rel u-bg-white u-height100 u-flex u-flex-col u-shadow3">
		    <button class="js-menu-hide slide-nav__hide u-abs u-z1 icon-refresh btn-round u-top0 u-left0 u-m1"></button>
		    <header class="slide-nav__header u-flex u-flex-end u-p2 u-h3 u-bg-2">
		      Side Nav
		    </header>
		    <ul class="slide-nav__content u-pt3 u-flexed-1 ">
		      <li>One</li>
		      <li>Two</li>
		      <li>Three</li>
		      <li>Four</li>
		    </ul>
		  </nav>
		</aside>

		<div <?php hybrid_attr( 'layout' ); ?>>
