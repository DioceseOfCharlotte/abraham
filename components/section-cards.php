<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($mehsc_atts['width']); ?> mdl-cell mdl-card mdl-shadow--2dp">


        <?php

        if ( 'show_img' === $mehsc_atts['show_image'] && has_post_thumbnail() ) {
        $feat_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
        ?>
        <div class="mdl-card__media mdl-color-text--grey-50 u-flex u-flex-row u-flex-end u-flexed-grow" style="background-image: url(<?php echo $feat_image_url ?>)">
          <h3><a class="mdl-card__title-text" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </div>
        <div class="mdl-card__supporting-text mdl-color-text--grey-600">

        <?php } else { ?>
        <div class="mdl-card__supporting-text">
            <h4><a class="mdl-card__title-text" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <?php } ?>
        <?php
        if ('excerpt' === $mehsc_atts['show_content']) {
          the_excerpt();
        } elseif ('content' === $mehsc_atts['show_content']) {
          the_content();
        }
        ?>
    </div>

    <div class="mdl-card__actions mdl-card--border">
      <a href="<?php the_permalink(); ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Go to section
      </a>
      <?php
        $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&link_after=</span>&link_before=<span class="mdl-menu__item mdl-js-ripple-effect">');
        if ($children) { ?>
       <button id="menu-<?php the_ID(); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
         <i class="material-icons" role="presentation">more_vert</i>
         <span class="visuallyhidden">show menu</span>
       </button>
       <ul class="mdl-menu mdl-menu--top-right mdl-js-menu mdl-js-ripple-effect" for="menu-<?php the_ID(); ?>">
         <?php echo $children; ?>
       </ul>
       <?php } ?>

    </div>
</div><!-- .block -->
