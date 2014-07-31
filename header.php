<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'abraham' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

				<div class="app-bar-container">
          <button class="menu-link btn-menu"><span></span></button>

        <?php if ( display_header_text() && !has_site_logo() ) : // If user chooses to display header text. ?>
				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

    <?php elseif ( display_header_text() && has_site_logo() ) : // If user chooses to display header text. ?>
				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php the_site_logo() ?>
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

		<?php elseif ( has_site_logo() ) : // If there's a header image. ?>
				<div <?php hybrid_attr( 'branding' ); ?>>
					<?php the_site_logo() ?>
				</div><!-- #branding -->

		<?php endif; // End check for header image. ?>

		<section class="app-bar-actions">
			<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>
        </section>
        		</div>

		</header><!-- #header -->

			<?php if ( get_header_image() ) : // If there's a header image. ?>

				<style type="text/css" id="custom-header-css">
				            .app-bar {
				      background: url(<?php header_image(); ?>) no-repeat scroll center;
				      background-size: cover;
				    }
				</style>

			<?php endif; // End check for header image. ?>

			<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
			
			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>

		<div class="main-container">
