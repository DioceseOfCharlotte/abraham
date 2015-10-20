<?php
add_filter('upload_mimes', 'meh_mime_types');
add_action('init', 'meh_post_type_layouts_supports');
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_script', 100 );

// Gravity Forms
add_filter( 'gform_replace_merge_tags', 'meh_reload_form_replace_merge_tag', 10, 2 );


function meh_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

function meh_post_type_layouts_supports() {
    add_post_type_support('thursday_packet', 'theme-layouts');
    add_post_type_support('gravityview', 'theme-layouts');
    add_post_type_support('sc_event', 'theme-layouts');
    add_post_type_support('cpt_archive', 'theme-layouts');
}

function wpdocs_dequeue_script() {
wp_dequeue_style( 'sc-events' );
}


// function autologin($user_id, $config, $entry, $password) {
//         wp_set_auth_cookie($user_id, false, '');
// }


function meh_reload_form_replace_merge_tag($text, $form) {

    preg_match_all('/{(reload_form):?([\s\w.,!?\'"]*)}/mi', $text, $matches, PREG_SET_ORDER);

    if(empty($matches))
        return $text;

    $link_text = rgar($matches[0], 2) ? rgar($matches[0], 2) : 'Reload Form';
    $reload_link = '<a href="" class="btn btn--default button--colored gws-reload-form">' . $link_text . ' <i class="material-icons">&#xE147;</i></a>';
    $text = str_replace(rgar($matches[0], 0), $reload_link, $text);

    return $text;

}
