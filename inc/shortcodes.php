<?php
add_action('init', 'meh_add_shortcodes');

function meh_add_shortcodes() {
    add_shortcode('meh_cards', 'meh_cards_shortcode');
    add_shortcode('meh_block', 'meh_block_shortcode');
    add_shortcode('meh_tabs', 'meh_tabs_shortcode');
    add_shortcode('meh_toggles', 'meh_toggles_shortcode');
}

/**
 * CARDS.
 */
function meh_cards_shortcode($atts, $content = null) {
    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'row_color'    => '',
        'row_intro'    => '',
        'width'        => '',
        'card_color'   => '',
        'page'         => '',
        'show_content' => '',
   ), $atts, 'meh_cards');

    $output = '<section class="' . $mehsc_atts['row_color'] . ' row pt3 pt4@md pb4@md pages-highlight"><div class="card-row container"><div class="h1 center mb3">' . $mehsc_atts['row_intro'] . '</div>';

// Get pages set (if any)
$pages = $mehsc_atts['page'];

    $args = array(
    'post_type' => 'department',
    'post__in'  => explode(',', $pages),
    'orderby'   => 'post__in',
);

    $query1 = new WP_Query($args);
    while ($query1->have_posts()) : $query1->the_post();

    ob_start();
    get_template_part('components/section', 'cards');
    $output .= ob_get_clean();

    endwhile;

    $output .= '</div></section>';

    return $output;
}

/**
 * BLOCK.
 */
function meh_block_shortcode($atts, $content = null) {
    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'block_type'   => '',
        'icon'         => '',
        'width'        => '',
        'page'         => '',
        'show_image'   => '',
        'show_content' => '',
   ), $atts, 'meh_block');

    $output = '<section class="row pages-highlight"><div class="block-row grid container flex flex-row@md flex--w">';

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
    wp_enqueue_script('meh_tabs');

    global $mehsc_atts;
    $mehsc_atts = shortcode_atts(array(
        'page'         => '',
        'bg_color'     => '',
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

    $output = '<section class="row pages-highlight pt3 pb3 bg1"><div class="container tabs">';
    ob_start();
    while ($query3->have_posts()) {
        $query3->the_post();
        ?>
    <button data-tab="#tab<?php the_ID();
        ?>"><?php the_title();
        ?></button>
<?php
    }
    ?>

<div class="tabs-content bg-darken-2 br p2">

<?php while ($query3->have_posts()) {
    $query3->the_post();
    ?>
    <div class="tabs-pane" id="tab<?php the_ID();
    ?>"><?php the_content();
    ?></div>
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
