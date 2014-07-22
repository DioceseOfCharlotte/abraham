<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container" class="container">

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'hybrid-base' ); ?></a>
		</div><!-- .skip-link -->

		<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

				<div class="app-bar-container">
          <button class="btn-menu"><img src="<?php echo get_bloginfo('template_directory');?>/images/hamburger.svg" alt="Menu"></button>
				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->
				<section class="app-bar-actions">
        <!-- Put App Bar Buttons Here -->
        </section>
        </div>

			<?php endif; // End check for header text. ?>

		</header><!-- #header -->

		<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

			<?php if ( get_header_image() ) : // If there's a header image. ?>

				<style type="text/css" id="custom-header-css">
				            .app-bar {
				      background: url(<?php header_image(); ?>) no-repeat scroll center;
				      background-size: cover;
				    }
				</style>

			<?php endif; // End check for header image. ?>

			<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		<div id="content" class="site-content">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
