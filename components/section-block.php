<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($mehsc_atts['width']); ?> grid__item px1 px2@md">

    <div class="<?php echo esc_attr($mehsc_atts['block_type']); ?> mb1 mb3@md bg-white u-br shadow2 u-1/1">
    <?php if ('show_img' === $mehsc_atts['show_image']) : ?>

    <?php
    if ('card-block' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'abraham-sm',
            'before' => '<div class="card-img u-1/1">',
            'after'  => '</div>',
        ));
    }
    if ('flag-block flex-row' === $mehsc_atts['block_type']) {
        get_the_image(array(
            'size'   => 'thumbnail',
            'before' => '<div class="flag-img u-1/3">',
            'after'  => '</div>',
        ));
    }
    ?>

    <?php endif; ?>

            <div class="block-body">
            <div class="card__title flex-justify flex-center flex p2">

                <a class="h2 entry-title inline-block card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

<!-- <button id="menu-<?php the_ID(); ?>" class="mdl-button mdl-js-button mdl-button--icon">
  <i class="material-icons">more_vert</i>
</button> -->

<!-- <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-<?php the_ID(); ?>">
  <li class="mdl-menu__item">Some Action</li>
  <li class="mdl-menu__item">Another Action</li>
  <li disabled class="mdl-menu__item">Disabled Action</li>
  <li class="mdl-menu__item">Yet Another Action</li>
</ul> -->

<?php
  $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
  if ($children) { ?>
      <button id="menu-<?php the_ID(); ?>" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">more_vert</i>
      </button>
  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-<?php the_ID(); ?>">
  <?php echo $children; ?>
  </ul>
<?php } ?>

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

<!--                 <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo get_permalink(); ?>"><i class="material-icons">more_horiz</i></a>
                </div> -->
                </div><!-- .block-body -->
    </div><!-- .mdl-card -->
</div><!-- .block -->

<?php
wp_reset_postdata();
