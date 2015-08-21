<?php

/**
 * Theme includes.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$abraham_includes = array(
    'inc/hybrid-core/hybrid.php',       // Hybrid Core library
    'inc/attr-trumps.php',              // Css class selectors
    'inc/utils.php',                    // Utility functions
    'inc/init.php',                     // Initial theme setup
    'inc/assets.php',                   // Scripts and styles
    'inc/titles.php',                   // Page titles
    'inc/tiny-mce.php',                 // Extra wysiwyg actions
    'inc/shortcodes.php',               // Shortcodes
    'inc/shortcodes-ui.php',            // Shortcake interface
    'inc/tha-theme-hooks.php',          // Template hooks
    'inc/template-actions.php',         // Action hooks
    'inc/customizer/customizer.php',    // Customizer
);

foreach ($abraham_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__(
        'Error locating %s', 'abraham'
        ), $file), E_USER_ERROR);
    }
    require_once $filepath;
}
unset($file, $filepath);

define('HYBRID_DIR', trailingslashit( get_template_directory()) . 'inc/hybrid-core/');
define('HYBRID_URI', trailingslashit( get_template_directory_uri()) . 'inc/hybrid-core/');

new Hybrid();






/* ======================================================================
	LOGOUT LINK
	Create a shortcode for the WordPress logout link.
 * ====================================================================== */
// Get logged-out redirect URL
function wpwebapp_get_redirect_url_logged_out() {
	return site_url();
}
// Logout Link Shortcode
function wpwebapp_get_logout_url() {
	$front_page = esc_url_raw( wpwebapp_get_redirect_url_logged_out() );
	$logout = wp_logout_url( $front_page );
	return $logout;
}
add_shortcode( 'wpwa_logout_url', 'wpwebapp_get_logout_url' );
// Logout Link Navigation Menu
// Let's you use the logout shortcode with `wp_nav_menu()`
function wpwebapp_menu_logout_url( $menu ){
	$logout_url = wpwebapp_get_logout_url();
	return str_replace( 'wpwa_logout_url', preg_replace( '~^(?:f|ht)tps?://~i', '', $logout_url ), do_shortcode( $menu ) );
}
add_filter('wp_nav_menu', 'wpwebapp_menu_logout_url');
/* ======================================================================
	DISPLAY USERNAME
	Create a shortcode to display a user's username.
 * ====================================================================== */
// Username Shortcode
function wpwebapp_display_username() {
	$current_user = wp_get_current_user();
	$username = $current_user->last_name;
	return $username;
}
add_shortcode( 'wpwebapp_display_username', 'wpwebapp_display_username' );
// Username Navigation Menu
// Let's you use the username shortcode with `wp_nav_menu()`
function wpwebapp_menu_display_username( $menu ){
	$username = wpwebapp_display_username();
	return str_replace( '[wpwa_display_username]', $username, do_shortcode( $menu ) );
}
add_filter('wp_nav_menu', 'wpwebapp_menu_display_username');
