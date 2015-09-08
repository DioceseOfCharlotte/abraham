<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

    <?php tha_entry_before(); ?>

        <?php if (is_singular(get_post_type())) : ?>

            <article <?php hybrid_attr('post'); ?>>

                <?php tha_entry_top(); ?>

            <div <?php hybrid_attr('entry-content'); ?>>
                <?php tha_entry_content_before(); ?>
                <?php the_content(); ?>
                <?php tha_entry_content_after(); ?>
            </div>

            <footer <?php hybrid_attr('entry-footer'); ?>>
                <?php wp_link_pages(array(
                    'before' => '<nav class="page-nav"><p>'.__('Pages:', 'abraham'),
                    'after'  => '</p></nav>',
                )); ?>
            </footer>

            <?php comments_template('', true); ?>

        <?php else : // If not viewing a single post. ?>

<article class="br mb2 bg-1 white mx2 shadow2 mb3@md py2 py3@md flex-auto u-1/4@md">

    <?php tha_entry_top(); ?>

            <header <?php hybrid_attr('entry-header'); ?>>

                <h2 <?php hybrid_attr('entry-title'); ?>>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </header>

            <div <?php hybrid_attr('entry-summary'); ?>>
                <?php tha_entry_content_before(); ?>
                <?php the_excerpt(); ?>
                <?php tha_entry_content_after(); ?>
            </div>
            <?php
            hybrid_post_terms(array(
                'taxonomy' => 'sc_event_category',
                'before'     => '<span class="btn white color-inherit">',
        		'after'      => '</span>',
            ));
            ?>
    	<?php endif; // End check for posts. ?>

    <?php tha_entry_bottom(); ?>

    </article>

    <?php tha_entry_after(); ?>

    <?php endwhile; ?>

    <?php the_posts_navigation( array(
    'prev_text'          => __( 'Previous page', 'abraham' ),
    'next_text'          => __( 'Next page', 'abraham' ),
) ); ?>

<?php
endif;
