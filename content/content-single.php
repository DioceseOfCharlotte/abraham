<?php if (have_posts()) : ?>

    <?php tha_content_while_before(); ?>

    <?php while (have_posts()) : the_post(); ?>

    <?php tha_entry_before(); ?>

            <article <?php hybrid_attr('post'); ?>>

                <?php tha_entry_top(); ?>

                <div <?php hybrid_attr('entry-content'); ?>>
                    <?php tha_entry_content_before(); ?>
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                    <?php tha_entry_content_after(); ?>
                </div>

                <?php get_template_part('components/entry', 'footer'); ?>

                <?php comments_template('', true); ?>

                <?php tha_entry_bottom(); ?>

            </article>

    <?php tha_entry_after(); ?>

    <?php endwhile; ?>

    <?php tha_content_while_after(); ?>

        <?php //get_template_part('components/loop', get_the_slug() ); ?>

<?php
endif;
