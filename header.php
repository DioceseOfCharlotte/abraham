<?php
/**
 * Site Header template.
 *
 * @package Abraham
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'components/head' ); ?>

<body <?php hybrid_attr( 'body' ); ?>>

	<?php tha_body_top(); ?>

	<div id="page" class="site">
		<a class="skip-link visuallyhidden focusable" href="#main"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

		<?php tha_header_before(); ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php tha_header_top(); ?>

			<?php if ( is_active_sidebar( 'secondary' ) ) { ?>

				<button class="js-menu-show header__menu-toggle u-h3 u-p05 u-inline-flex u-flex-center u-mr1 u-z2">
					<span class="u-h6 toggle-text u-align-middle"><?php esc_html_e( 'menu', '_s' ); ?></span>
						<?php abe_do_svg( 'side-toggle', 'sm' ); ?>
				</button>

			<?php } ?>

			<?php get_template_part( 'components/site', 'branding' ); ?>

			<?php hybrid_get_menu( 'primary' ); ?>

			<?php tha_header_bottom(); ?>

		</header>

		<?php tha_header_after(); ?>

		<div class="site-wrap u-flex u-flex-col">
