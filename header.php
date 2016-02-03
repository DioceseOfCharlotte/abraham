<?php
/**
 * Site Header template.
 *
 * @package abraham
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr('head'); ?>>
<?php wp_head(); ?>
</head>

<body <?php hybrid_attr('body'); ?>>

	<?php tha_body_top(); ?>

	<div <?php hybrid_attr('site_container'); ?>>

		<?php tha_header_before(); ?>

		<header <?php hybrid_attr('header'); ?>>

			<?php tha_header_top(); ?>

			<?php get_template_part('components/site', 'branding'); ?>



			<?php tha_header_bottom(); ?>

		</header>

		<?php tha_header_after(); ?>

			<div <?php hybrid_attr('layout'); ?>>
