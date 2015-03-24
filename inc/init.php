<?php
/**
 * @package Abraham
 */


/* Register custom menus. */
add_action( 'init', 'abraham_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'abraham_sidebars', 5 );

/* Add post type to theme-layouts. */
add_action( 'init', 'abraham_theme_layouts_add_cpt' );




function abraham_menus() {
	register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'abraham' ) );
	register_nav_menu( 'social',  _x( 'Social',  'nav menu location', 'abraham' ) );
}




function abraham_sidebars() {
	hybrid_register_sidebar( [
		'id'			=> 'primary',
		'name'			=> _x( 'Primary', 'sidebar', 'abraham' ),
		'description'	=> __( 'The Primary sidebar.', 'abraham' ),
		'before_widget'	=> '<section id="%1$s" class="widget sidebar-primary__widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'  => '<h3 class="widget-title sidebar-primary__widget-title">',
		'after_title'	=> '</h3>',
	] );

	hybrid_register_sidebar( [
		'id'			=> 'footer',
		'name'			=> _x( 'Footer Widgets', 'sidebar', 'abraham' ),
		'description'	=> __( 'Typically located in the footer.', 'abraham' ),
		'before_widget' => '<section id="%1$s" class="widget sidebar-footer__widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'  => '<h3 class="widget-title sidebar-footer__widget-title">',
		'after_title'   => '</h3>',
	] );

	hybrid_register_sidebar( [
		'id'            => 'header-right',
		'name'          => _x( 'Header Right', 'sidebar', 'abraham' ),
		'description'   => __( 'The header right sidebar area.', 'abraham' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	] );
}




function abraham_theme_layouts_add_cpt() {
	add_post_type_support( 'gravityview', 'theme-layouts' );
}
