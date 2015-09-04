<?php if (have_posts()) : ?>
<div class="facetwp-template">
    <?php while (have_posts()) : the_post(); ?>

    <?php tha_entry_before(); ?>

    <article <?php hybrid_attr('post'); ?>>

        <?php tha_entry_top(); ?>

        <?php if (is_singular(get_post_type())) : ?>

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

    	<?php endif; // End check for posts. ?>

    <?php tha_entry_bottom(); ?>
<?php    hybrid_post_terms(array(
        'taxonomy' => 'category',
        'text'     => __('Posted in %s', 'stargazer')
    ));

    hybrid_post_terms(array(
        'taxonomy' => 'post_tag',
        'text'     => __('Tagged %s', 'stargazer'),
        'before'   => '<br />'
    )); ?>
    </article>

    <?php tha_entry_after(); ?>

    <?php endwhile; ?>
</div>
    <?php the_posts_navigation( array(
    'prev_text'          => __( 'Previous page', 'abraham' ),
    'next_text'          => __( 'Next page', 'abraham' ),
) ); ?>

<?php
endif;
