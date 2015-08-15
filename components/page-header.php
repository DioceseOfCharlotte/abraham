<?php use Abraham\Titles;

if (is_home() || is_front_page()) {
    return;
}
?>

<div <?php hybrid_attr('archive-header'); ?>>

    <?php hybrid_get_menu('breadcrumbs'); ?>

    <h1 <?php hybrid_attr('archive-title'); ?>><?= Titles\title(); ?></h1>
</div>
