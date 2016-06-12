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

			<?php if ( is_active_sidebar( 'secondary' ) ) { ?>

				<button class="js-menu-show header__menu-toggle btn-sm u-h3 u-mr2 u-z2">
					<span class="u-f-minus u-bold hidden-sm u-align-middle"><?php esc_html_e( 'menu', '_s' ); ?></span>
						<?php abe_do_svg( 'side-toggle', 'sm' ); ?>
				</button>

			<?php } ?>

			<?php get_template_part( 'components/site', 'branding' ); ?>

			<?php hybrid_get_menu( 'primary' ); ?>

			<?php tha_header_bottom(); ?>

		</header>

		<?php tha_header_after(); ?>

		<div <?php hybrid_attr( 'layout' ); ?>>
