<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div class="<?php echo esc_attr($mehsc_atts['width']); ?> grid__item px2 mb3">

<div class="<?php echo esc_attr($mehsc_atts['card_color']); ?> card shadow2 overflow-hidden u-br">
        <?php
            get_the_image(array(
                'size'         => 'abraham-sm',
                'before'       => '<div class="card__figure">',
                'after'        => '</div>',
                //'link_to_post' => false,
            ));
        ?>
    <div class="card-divider p2 color-inherit">
    <?php the_title(sprintf('<a class="h3 card__title--link" href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?>
    </div>
    <div class="card-section px2 pb2">
        <?php the_excerpt(); ?>
    </div>
</div>
</div>

<?php
wp_reset_postdata();
