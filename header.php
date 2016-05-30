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

		<?php tha_header_before(); ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php tha_header_top(); ?>

			<button class="js-menu-show header__menu-toggle btn-round u-bg-frost-1 u-mx2 u-z2">
				<?php abe_do_svg( 'menu', 'sm' ); ?>
			</button>

			<?php get_template_part( 'components/site', 'branding' ); ?>

			<?php hybrid_get_menu( 'primary' ); ?>

			<?php tha_header_bottom(); ?>

		</header>

		<?php tha_header_after(); ?>

		<div <?php hybrid_attr( 'layout' ); ?>>
