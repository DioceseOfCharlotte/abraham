<?php
/**
 * @package Abraham
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php wp_head(); ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

  <?php tha_body_top(); ?>

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'abraham' ); ?></a>

    <?php tha_header_before(); ?>

		<header <?php hybrid_attr( 'header' ); ?>>

		<?php tha_header_top(); ?>

			<div <?php hybrid_attr( 'branding' ); ?>>
				<button class="menu-toggle" aria-controls="menu-primary" aria-expanded="false"><span></span></button>

				<?php if ( get_theme_mod( 'logo', 0 ) ) {
					$output = '<img src="' . esc_url( get_theme_mod( 'logo' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">'; ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
						<?php echo $output; ?>
					</a>
				<?php } ?>

				<?php hybrid_site_title(); ?>
				<?php hybrid_site_description(); ?>
			</div><!-- .site-branding -->

			<?php hybrid_get_sidebar( 'header-right' ); ?>

		<?php tha_header_bottom(); ?>

		</header><!-- #header -->

		<?php tha_header_after(); ?>

		<?php hybrid_get_menu( 'primary' ); ?>

		<?php hybrid_get_menu( 'breadcrumbs' ); ?>

		<div class="main-container">
