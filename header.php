<!doctype html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr('head'); ?>>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php tha_head_top(); ?>
<?php wp_head(); ?>
<?php tha_head_bottom(); ?>
</head>
<body <?php hybrid_attr('body'); ?>>

    <?php tha_body_top(); ?>

    <div class="skip-link">
        <a href="#content" class="button screen-reader-text">
            <?php _e( 'Skip to content (Press enter)', 'compass' ); ?>
        </a>
    </div><!-- .skip-link -->

    <?php tha_header_before(); ?>

    <header <?php hybrid_attr('header'); ?>>

        <?php tha_header_top(); ?>

        <div class="header-wrap container--wide px2 flex flex-column@sm flex-justify flex-center">
            <div <?php hybrid_attr('branding'); ?>>

                <?php if( '1' == get_theme_mod( 'svg_logo' ) ) { ?>
                    <a class="logo-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php get_template_part( 'images/svg', 'logo' ); ?>
                    </a>
                <?php } ?>

                <?php hybrid_site_title(); ?>
                <?php hybrid_site_description(); ?>
            </div>

            <?php hybrid_get_menu('primary'); ?>
        </div>

        <?php tha_header_bottom(); ?>

    </header>

    <?php tha_header_after(); ?>
