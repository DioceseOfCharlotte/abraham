<?php
/**
 * This is the template for the different block-type shortcodes.
 */
global $mehsc_atts;
?>

<a class="collapse-toggle u-inline-block u-flexed-first u-text-center" data-collapse="#section<?php the_ID(); ?>" data-group="accordion" href="#">
    <?php get_template_part('images/icon', get_the_slug() ); ?>
    <h5><?php the_title(); ?></h5>
</a>
<div class="collapse mui-enter slideInUp fast" id="section<?php the_ID(); ?>">
    <h4><?php the_title(); ?></h4>
    <?php
    if ('excerpt' === $mehsc_atts['show_content']) {
      the_excerpt();
    } elseif ('content' === $mehsc_atts['show_content']) {
      the_content();
    }
    ?>
</div>

<?php
