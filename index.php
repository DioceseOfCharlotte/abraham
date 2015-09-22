<?php
get_header(); ?>

    <?php get_template_part('components/page', 'header'); ?>

    <div <?php hybrid_attr('layout'); ?>>

        <?php tha_content_before(); ?>

        <main <?php hybrid_attr('content'); ?>>

            <?php tha_content_top(); ?>

            <?php hybrid_get_content_template(); ?>

            <?php tha_content_bottom(); ?>

        </main><!-- /.main -->

        <?php tha_content_after(); ?>

        <?php hybrid_get_sidebar('primary'); ?>

    </div><!-- /.layout -->

<?php
get_footer();
