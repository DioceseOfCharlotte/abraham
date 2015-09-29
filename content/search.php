<?php if (!have_posts()) : ?>

<?php tha_entry_before(); ?>

<section <?php hybrid_attr('post'); ?>>

    <div <?php hybrid_attr('entry-summary'); ?>>

        <?php _e('Sorry, no results were found.', 'abraham'); ?>
    </div>

    <?php get_search_form(); ?>

</section>

<?php tha_entry_after(); ?>

<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

    <?php tha_entry_before(); ?>

    <article <?php hybrid_attr('post'); ?>>

    <?php tha_entry_top(); ?>

        <header <?php hybrid_attr('entry-header'); ?>>
            <h4 <?php hybrid_attr('entry-title'); ?>>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>

            <?php if (get_post_type() === 'post') {
                get_template_part('components/entry-meta');
            } ?>
        </header>

        <div <?php hybrid_attr('entry-summary'); ?>>
        <?php the_excerpt(); ?>
        </div>

    <?php tha_entry_bottom(); ?>

    </article>

    <?php tha_entry_after(); ?>

<?php endwhile; ?>

<?php the_posts_navigation(); ?>
