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

	<?php get_template_part( 'components/header', 'image' ); ?>

	<div id="page" class="site">
		<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php if ( is_active_sidebar( 'secondary' ) ) { ?>

				<button class="js-menu-show header__menu-toggle u-flex u-mr1 u-p0 u-z2">
					<div class="u-inline-flex u-flex-center u-h3 u-p05">
					<span class="u-h6 toggle-text u-align-middle"><?php esc_html_e( 'menu', '_s' ); ?></span>
						<?php abe_do_svg( 'side-toggle', 'sm' ); ?>
					</div>
				</button>

			<?php } ?>

			<?php get_template_part( 'components/site', 'branding' ); ?>

			<?php hybrid_get_menu( 'primary' ); ?>

		</header>
