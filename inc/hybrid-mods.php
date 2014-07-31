<?php
/**
 * Edits to the Hybrid-core Framework
 *
 */

add_filter( 'hybrid_attr_header', 'meh_attr_header' );

function meh_attr_header( $attr ) {

	$attr['class'] = 'app-bar';

	return $attr;
}

add_filter( 'hybrid_attr_site-title', 'meh_attr_sitetitle' );

function meh_attr_sitetitle( $attr ) {

  $attr['class'] = 'site-title';

  return $attr;
}

add_filter( 'hybrid_attr_entry_title', 'meh_attr_entry_title' );

function meh_attr_entry_title( $attr ) {

  $attr['class'] .= ' xxlarge text-divider';

  return $attr;
}

add_filter( 'hybrid_attr_footer', 'meh_attr_footer' );

function meh_attr_footer( $attr ) {

  $attr['class'] = 'footer';

  return $attr;
}

add_filter( 'hybrid_attr_content', 'meh_attr_content' );

function meh_attr_content( $attr ) {

  $attr['class'] = 'site-main';

  return $attr;
}

add_filter( 'hybrid_attr_branding', 'meh_attr_branding' );

function meh_attr_branding( $attr ) {

  $attr['class'] = 'branding';
  $attr['itemscope'] = '';
  $attr['itemtype']  = 'http://schema.org/Organization';

  return $attr;
}

add_filter( 'hybrid_attr_site_description', 'meh_attr_site_description' );

function meh_attr_site_description( $attr ) {

  $attr['class'] = 'site_description';

  return $attr;
}

add_filter( 'hybrid_attr_sidebar', 'meh_attr_sidebar', 10, 2 );

function meh_attr_sidebar( $attr, $context ) {

  $attr['class'] = "Sidebar-{$context} Sidebar";

  return $attr;
}

add_filter( 'hybrid_attr_menu', 'meh_attr_menu', 10, 2 );

function meh_attr_menu( $attr, $context ) {

  $attr['class'] = "Menu-{$context} Menu";

  return $attr;
}

add_filter('show_admin_bar', '__return_false');

if ( current_theme_supports( 'wsk-head' ) ) {

add_action( 'init', 'meh_clean_head' );
function meh_clean_head() {

remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink
remove_action('wp_head', 'rel_canonical', 10, 0 ); // remove canonical link
remove_action( 'wp_head', 'wp_generator', 1 );


remove_action( 'wp_head', 'hybrid_meta_charset',  0 );
remove_action( 'wp_head', 'hybrid_doctitle',      0 );
remove_action( 'wp_head', 'hybrid_meta_viewport', 1 );
remove_action( 'wp_head', 'hybrid_meta_template', 1 );
remove_action( 'wp_head', 'hybrid_link_pingback', 3 );
}

}