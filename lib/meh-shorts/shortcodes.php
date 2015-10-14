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
    <section class="' . $mehsc_atts['row_color'] . ' row py3 py4@md pages-highlight">
        <div class="mdl-typography--display-1-color-contrast">' . $mehsc_atts['row_intro'] . '</div>
        <div class="card-row mdl-grid">
    ';

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
        'post_type' => 'page',
        'post__in'  => explode(',', $pages),
        'orderby'   => 'post__in',
    );

    $queryTile = new WP_Query($args);
    while ($queryTile->have_posts()) : $queryTile->the_post();

    ob_start();
    get_template_part('components/section', 'tile');
    $output .= ob_get_clean();

    endwhile;

    $output .= '
        </div>
    </section>
    ';

    return $output;
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
 * TABS.
 */
function meh_tabs_shortcode($atts, $content = null) {
    //wp_enqueue_script('meh_tabs');

    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'page'         => '',
        'row_color'     => '',
        'show_content' => '',
   ), $atts, 'meh_tabs');

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
    'post_type' => 'page',
    'post__in'  => explode(',', $pages),
    'orderby'   => 'post__in',
);

    $query3 = new WP_Query($args);

    $output = '<section class="' . $mehsc_atts['row_color'] . ' row pt3 pt4@md pb4@md pages-highlight"><div class="container mdl-tabs mdl-js-tabs mdl-js-ripple-effect">';
    ob_start(); ?>
    <div class="mdl-tabs__tab-bar flex-column@sm bg-1--dark white color-inherit">
    <?php
        while ($query3->have_posts()) {
        $query3->the_post();
        ?>
        <a href="#tab<?php the_ID(); ?>" class="mdl-tabs__tab meh__tab br0 u-1/1@sm"><?php the_title(); ?></a>
    <?php
        } ?>
    </div>
<div class="tabs-content bg-white p3 p4@lg">
<?php while ($query3->have_posts()) {
    $query3->the_post();
    ?>
    <div class="tabs-pane mdl-tabs__panel" id="tab<?php the_ID(); ?>">
        <?php the_content(); ?>
    </div>
<?php
}
?>
</div>
<?php
$output .= ob_get_clean();
    $output .= '</div></section>';

    return $output;

    wp_reset_postdata();
}

/**
 * TOGGLES.
 */
function meh_toggles_shortcode($atts, $content = null) {
    wp_enqueue_script('meh_toggles');

    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'page'         => '',
        'bg_color'     => '',
        'show_content' => '',
   ), $atts, 'meh_toggles');

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
    'post_type' => 'page',
    'post__in'  => explode(',', $pages),
    'orderby'   => 'post__in',
);

    $query4 = new WP_Query($args);

    $output = '<section class="row pages-highlight t-bg--2-light u-pt+ u-pb+"><div class="container toggles">';
    ob_start();
    while ($query4->have_posts()) {
        $query4->the_post();
        ?>
<li class="toggle__item">
<a class="collapse-toggle u-h4 t-color--black u-p-" data-collapse="#section<?php the_ID();
        ?>" data-group="accordion" href="#">
    <?php the_title();
        ?>
    <i class="material-icons u-h2 u-absolute u-right0 collapse-text-show">&#xE313;</i>
    <i class="material-icons u-h2 u-absolute u-right0 collapse-text-hide">&#xE316;</i>
</a>
<div class="collapse t-bg--frost u-radius" id="section<?php the_ID();
        ?>">
    <?php the_content();
        ?>
</div>
</li>
<?php

    }

    $output .= ob_get_clean();
    $output .= '</div></section>';

    return $output;

    wp_reset_postdata();
}
