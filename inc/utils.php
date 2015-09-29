<?php

namespace Abraham\Utils;

add_filter('hybrid_content_template_hierarchy', __NAMESPACE__.'\\template_hierarchy');
add_filter('get_search_form', __NAMESPACE__.'\\get_search_form');
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');
add_filter('excerpt_length', __NAMESPACE__.'\\excerpt_length');
add_action('after_setup_theme', __NAMESPACE__.'\\responsive_videos', 99);
//add_filter( 'page_css_class', __NAMESPACE__.'\\doc_page_css_class', 10, 2 );
add_filter('show_admin_bar', '__return_false');

add_filter( 'gform_replace_merge_tags', __NAMESPACE__.'\\meh_reload_form_replace_merge_tag', 10, 2 );


/**
 * Add templates to hybrid_get_content_template()
 */
function template_hierarchy($templates) {
        $post_type = get_post_type();
        $post_slug = get_the_slug();
    if (is_search()) {
        $templates = array_merge(array('content/search.php'), $templates);
    } elseif (is_404()) {
        $templates = array_merge(array('content/404.php'), $templates);
    } elseif (is_singular()) {
        $templates = array_merge(array("content/content-single.php"), $templates);
        $templates = array_merge(array("content/{$post_type}-single.php"), $templates);
        $templates = array_merge(array("content/{$post_type}-{$post_slug}.php"), $templates);
    }

    return $templates;
}


/**
 * Tell WordPress to use searchform.php from the components/ directory.
 */
function get_search_form() {
    $form = '';
    locate_template('/components/searchform.php', true, false);

    return $form;
}

/**
 * Clean up the_excerpt().
 */
function excerpt_more() {
    return '<a class="absolute btn-readmore z1 right-0 bottom-0" href="'.get_permalink().'"><i class="material-icons">more_horiz</i></a>';
}

function excerpt_length($length) {
    return 40;
}

function responsive_videos() {
    add_filter('wp_video_shortcode', __NAMESPACE__.'\\responsive_videos_embed_html');
    add_filter('embed_oembed_html', __NAMESPACE__.'\\responsive_videos_embed_html');
    add_filter('video_embed_html', __NAMESPACE__.'\\responsive_videos_embed_html');

    /* Wrap videos in Buddypress */
    add_filter('bp_embed_oembed_html', __NAMESPACE__.'\\responsive_videos_embed_html');
}

/**
 * Adds a wrapper to videos and enqueue script.
 *
 * @return string
 */
function responsive_videos_embed_html($html) {
    if (empty($html) || !is_string($html)) {
        return $html;
    }

    return '<div class="flex-embed"><div class="flex-embed__ratio flex-embed__ratio--16by9"></div>'.$html.'</div>';
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




function doc_page_css_class( $css_class, $page ) {

	if ( ! members_can_current_user_view_post( $page->ID ) )
		$css_class[] = 'is-protected muted';

	return $css_class;
}


function get_the_slug( $id=null ){
    if( empty($id) ):
        global $post;
    if( empty($post) )
        return ''; // No global $post var available.
        $id = $post->ID;
    endif;

    $slug = basename( get_permalink($id) );
    return $slug;
}
