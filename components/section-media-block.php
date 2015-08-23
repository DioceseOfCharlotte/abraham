<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div class="<?php echo esc_attr($mehsc_atts['width']); ?> media-block-item grid">

<div class="<?php echo esc_attr($mehsc_atts['card_color']); ?> card shadow--z1 u-radius">
        <?php
            get_the_image(array(
                'size'         => 'abraham-sm',
                'before'       => '<div class="card__figure">',
                'after'        => '</div>',
                'link_to_post' => false,
            ));
        ?>
    <div class="card-divider">
    <?php the_title(sprintf('<a class="u-h3 card__title--link" href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?>
    </div>
    <div class="card-section">
        <?php the_excerpt(); ?>
    </div>
</div>
</div>

<?php
wp_reset_postdata();
