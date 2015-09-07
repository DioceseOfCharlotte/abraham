<?php if (is_home() || is_front_page()) {
    return;
}
?>

<div <?php hybrid_attr('archive-header'); ?>>

    <?php hybrid_get_menu('breadcrumbs'); ?>

    <h1 <?php hybrid_attr('archive-title'); ?>>
        <?php
        if (is_archive()) {
            echo get_the_archive_title();
        } elseif (is_search()) {
            echo sprintf(esc_html__('Search Results for %s', 'abraham'), get_search_query());
        } elseif (is_404()) {
            echo esc_html__('Not Found', 'abraham');
        } elseif (!hybrid_is_plural() && !is_404()) {
            echo get_the_title();
        }
        ?>
    </h1>
</div>
