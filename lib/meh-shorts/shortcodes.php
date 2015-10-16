<?php
add_action('init', 'meh_add_shortcodes');

function meh_add_shortcodes() {
    add_shortcode('meh_block', 'meh_block_shortcode');
    add_shortcode('meh_tile', 'meh_tile_shortcode');
    add_shortcode('meh_tabs', 'meh_tabs_shortcode');
    add_shortcode('meh_toggles', 'meh_toggles_shortcode');
}

/**
 * BLOCK.
 */
function meh_tile_shortcode($atts, $content = null) {
    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'row_color'    => '',
        'row_intro'    => '',
        'width'        => '',
        'page'         => '',
   ), $atts, 'meh_tile');

    $output = '
    <section class="' . $mehsc_atts['row_color'] . ' section-row u-p3 u-py4@md">
        <div class="mdl-typography--display-1-color-contrast u-mb3 u-mb4@md u-text-center">' . $mehsc_atts['row_intro'] . '</div>
        <div class="card-row mdl-grid u-flex-justify-around">
    ';

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
        'post_type' => 'cpt_archive',
        'post__in'  => explode(',', $pages),
        'orderby'   => 'post__in',
    );

    $queryTile = new WP_Query($args);
    while ($queryTile->have_posts()) : $queryTile->the_post();

    ob_start();
    get_template_part('components/section', 'tile');
    $output .= ob_get_clean();

    endwhile;

    $output .= '</div></section>';

    return $output;

    wp_reset_postdata();
}




/**
 * BLOCK.
 */
function meh_block_shortcode($atts, $content = null) {
    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'row_color'    => '',
        'row_intro'    => '',
        'block_type'   => '',
        'width'        => '',
        'page'         => '',
        'show_image'   => '',
        'show_content' => '',
   ), $atts, 'meh_block');

    $output = '<section class="' . $mehsc_atts['row_color'] . ' row py3 py4@md pages-highlight"><div class="mdl-typography--display-1-color-contrast">' . $mehsc_atts['row_intro'] . '</div><div class="card-row card-columns">';

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
        'post_type' => 'page',
        'post__in'  => explode(',', $pages),
        'orderby'   => 'post__in',
    );

    $query2 = new WP_Query($args);
    while ($query2->have_posts()) : $query2->the_post();

    ob_start();
    get_template_part('components/section', 'block');
    $output .= ob_get_clean();

    endwhile;

    $output .= '</div></section>';

    return $output;
}




/**
 * TOGGLES.
 */
function meh_toggles_shortcode($atts, $content = null) {
    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'page'         => '',
        'show_content' => '',
        'row_color'    => '',
        'row_intro'    => '',
   ), $atts, 'meh_toggles');

   $output = '
   <section class="' . $mehsc_atts['row_color'] . ' section-row u-p3 u-py4@md">
       <div class="mdl-typography--display-1-color-contrast u-mb3 u-mb4@md u-text-center">' . $mehsc_atts['row_intro'] . '</div>
       <div class="container toggles u-flex u-flex-wrap u-flex-justify-around">';

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
    'post_type' => 'department',
    'post__in'  => explode(',', $pages),
    'orderby'   => 'post__in',
);

$queryToggle = new WP_Query($args);
while ($queryToggle->have_posts()) : $queryToggle->the_post();

    ob_start();
    get_template_part('components/section', 'toggles');
    $output .= ob_get_clean();

endwhile;

    $output .= '</div></section>';

    return $output;

    wp_reset_postdata();
}
