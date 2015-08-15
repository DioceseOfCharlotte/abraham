<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($mehsc_atts['width']); ?> grid__item px1@md pb2 <?php echo esc_attr($mehsc_atts['block_type']); ?>">

    <div class="mdl-card shadow2 u-1/1">
    <?php if ('show_img' === $mehsc_atts['show_image']) : ?>

    <?php
    if ('card-block' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'abraham-sm',
            'before' => '<div class="card-img">',
            'after'  => '</div>',
        ));
    } elseif ('flag-block' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'thumbnail',
            'before' => '<div class="u-left">',
            'after'  => '</div>',
        ));
    }
    ?>

    <?php endif; ?>


            <div class="mdl-card__title mdl-card--expand">
            <?php the_title(sprintf('<a class="h2 mdl-card__title-text" href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?>
            </div>
            <?php if ('excerpt' === $mehsc_atts['show_content']) : ?>

                <div class="mdl-card__supporting-text">
                <?php the_excerpt(); ?>
                </div>

            <?php elseif ('content' === $mehsc_atts['show_content']) : ?>

                <div class="mdl-card__supporting-text">
                <?php the_content(); ?>
                </div>

            <?php endif; ?>

<!--                 <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo get_permalink(); ?>"><i class="material-icons">more_horiz</i></a>
                </div> -->

    </div><!-- .mdl-card -->
</div><!-- .block -->

<?php
wp_reset_postdata();
