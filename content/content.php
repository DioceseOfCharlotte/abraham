<?php if (have_posts()) : ?>

    <?php tha_content_while_before(); ?>

    <?php while (have_posts()) : the_post(); ?>

    <?php tha_entry_before(); ?>

    <article <?php hybrid_attr('post'); ?>>

        <?php tha_entry_top(); ?>

            <header <?php hybrid_attr('entry-header'); ?>>
                <?php
                    get_the_image(array(
                        'size' => 'abraham-lg',
                    ));
                ?>
                <h2 <?php hybrid_attr('entry-title'); ?>>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </header>

            <div <?php hybrid_attr('entry-summary'); ?>>
                <?php tha_entry_content_before(); ?>
                <?php the_excerpt(); ?>
                <?php tha_entry_content_after(); ?>
            </div>

            <?php get_template_part('components/entry', 'footer'); ?>

    <?php tha_entry_bottom(); ?>

    </article>

    <?php tha_entry_after(); ?>

    <?php endwhile; ?>

    <?php tha_content_while_after(); ?>

    <?php get_template_part('components/posts', 'pagination'); ?>
    
<?php
endif;
