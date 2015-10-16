<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<a class="collapse-toggle u-inline-block u-flexed-first u-text-center u-color-inherit" data-collapse="#section<?php the_ID(); ?>" data-group="accordion" href="#">
    <?php get_template_part('images/icon', get_the_slug() ); ?>
    <h5><?php the_title(); ?></h5>
</a>
<div class="collapse u-overflow-hidden u-px3 u-mxn3 mui-enter slideInUp fast" id="section<?php the_ID(); ?>">
    <div class="mdl-typography--display-1-color-contrast u-py3"><?php the_title(); ?></div>
    <?php
    if ('excerpt' === $mehsc_atts['show_content']) {
      the_excerpt();
    } elseif ('content' === $mehsc_atts['show_content']) {
      the_content();
    }
    ?>
</div>

<?php
