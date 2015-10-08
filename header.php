<?php
/**
 * Main template file.
 *
 * @package abraham
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr('head'); ?>>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php wp_head(); ?>
</head>

<body <?php hybrid_attr('body'); ?>>

    <?php tha_body_top(); ?>

    <div <?php hybrid_attr('site_container'); ?>>

        <?php tha_header_before(); ?>

        <header <?php hybrid_attr('header'); ?>>

            <div <?php hybrid_attr('branding'); ?>>

                <?php tha_header_top(); ?>

                <?php if( '1' == get_theme_mod( 'svg_logo' ) ) { ?>
                    <a class="logo-image u-z4 u-p1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php get_template_part( 'images/svg', 'logo' ); ?>
                    </a>
                <?php } ?>
                <div class="title-text u-flex u-flexed-start u-flex-column-rev u-p1">
                    <?php hybrid_site_title(); ?>
                    <?php hybrid_site_description(); ?>
                </div>
                <?php tha_header_bottom(); ?>

            </div>


            <?php hybrid_get_menu('primary'); ?>

        </header>

        <?php tha_header_after(); ?>

            <div <?php hybrid_attr('layout'); ?>>
