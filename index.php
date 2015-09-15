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
<?php get_template_part( 'assets/css/critical', 'css' ); ?>
</head>

    <body <?php hybrid_attr('body'); ?>>

        <?php tha_body_top(); ?>

        <div <?php hybrid_attr('container', 'layout'); ?>>

        <?php get_header(); ?>

        <?php get_template_part('components/page', 'header'); ?>

        <div <?php hybrid_attr('container', 'content'); ?>>

            <div <?php hybrid_attr('row', 'layout'); ?>>

                <?php tha_content_before(); ?>

                <main <?php hybrid_attr('content'); ?>>

                    <?php tha_content_top(); ?>

                    <?php hybrid_get_content_template(); ?>

                    <?php tha_content_bottom(); ?>

                </main><!-- /.main -->

                <?php tha_content_after(); ?>

                <?php hybrid_get_sidebar('primary'); ?>

            </div><!-- /.row -->

        </div><!-- /.container__content -->

        <?php get_footer(); ?>

        </div><!-- /.content -->

        <?php tha_body_bottom(); ?>

    </body>
</html>
