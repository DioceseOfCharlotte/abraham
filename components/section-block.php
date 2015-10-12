<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($mehsc_atts['width']); ?> mdl-cell mdl-card mdl-shadow--3dp">


    <?php if ('show_img' === $mehsc_atts['show_image']) : ?>

    <?php
    if ('card-block' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'abraham-sm',
            'before' => '<div class="card-img u-1/1">',
            'after'  => '</div>',
        ));
    }
    if ('flag-block' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'thumbnail',
            'before' => '<div class="flag-img u-1/3">',
            'after'  => '</div>',
        ));
    }
    ?>

    <?php endif; ?>

            <div class="block-body">
            <div class="card__title flex-justify flex-center flex p2 color-inherit">

                <a class="h2 entry-title inline-block card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>




            </div>
            <?php if ('excerpt' === $mehsc_atts['show_content']) : ?>

                <div class="card__supporting-text border-top p2">
                <?php the_excerpt(); ?>
                </div>

            <?php elseif ('content' === $mehsc_atts['show_content']) : ?>

                <div class="card__supporting-text border-top p2">
                <?php the_content(); ?>
                </div>

            <?php endif; ?>

            <div class="mdl-card__actions mdl-card--border flex border-top flex-center p1/2 px1">
                <a href="<?php the_permalink(); ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect small">
                Go to section
                </a>
                <div class="mdl-layout-spacer flex-grow"></div>
              <?php
                $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&depth=1');
                if ($children) { ?>
                    <button id="menu-<?php the_ID(); ?>" class="btn btn--tiny round mdl-js-button">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--top-right mdl-js-menu mdl-js-ripple-effect" for="menu-<?php the_ID(); ?>">
                        <?php echo $children; ?>
                    </ul>
                <?php } ?>
            </div>

                </div><!-- .block-body -->

</div><!-- .block -->

<?php
wp_reset_postdata();
