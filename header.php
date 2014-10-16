<?php
/**
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Abraham
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri() ?>/images/touch/chrome-touch-icon-192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ?>/apple-touch-icon-precomposed.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() ?>/images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <?php wp_head(); ?>
  </head>

<body <?php hybrid_attr( 'body' ); ?>>

		<!--[if lt IE 9]>
		  <div class="alert alert-warning">
			  <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://whatbrowser.org">upgrade your browser</a> for a faster, safer, and more pleasant experience.', 'abraham'); ?>
			</div>
		<![endif]-->

<div class="site">

		<a href="#content" class="screen-reader-text visuallyhidden"><?php _e( 'Skip to main content', 'abraham' ); ?></a>

	<header <?php hybrid_attr( 'header' ); ?>>
		<div class="app-bar__container">
			<button class="navdrawer__toggle"><span class="toggle-btn"></span></button>
			<div <?php hybrid_attr( 'branding' ); ?>>
				<?php hybrid_site_title(); ?>
				<?php hybrid_site_description(); ?>
			</div>
			<section class="app-bar__actions">
	        	<?php hybrid_get_menu( 'social' ); ?>
	        </section>
		</div>

	<?php if ( get_header_image() ) : // If there's a header image. ?>

            	<style type="text/css" id="custom-header-css">
				            .app-bar {
				      background: url(<?php header_image(); ?>) no-repeat scroll center;
				      background-size: cover;
				    }
				</style>

    <?php endif; // End check for header image. ?>
    </header>

	<?php hybrid_get_menu( 'secondary' ); ?>

    <div class="wrapper"><?php hybrid_get_menu( 'breadcrumbs' ); ?></div>

	<div class="layout main-container wrapper">
