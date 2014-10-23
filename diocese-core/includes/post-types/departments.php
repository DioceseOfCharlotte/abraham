<?php
/**
 * File for registering custom post types.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register custom post types on the 'init' hook. */
add_action( 'init', 'doc_departments_register_post_types' );

/* Filter the "enter title here" text. */
add_filter( 'enter_title_here', 'department_enter_title_here', 10, 2 );

function doc_departments_register_post_types() {

    /* Register the Department post type. */

    register_post_type(
        'department',
        array(
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-groups',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => 'departments',
            'query_var'           => 'department',
            'capability_type'     => 'page',
            'map_meta_cap'        => true,

            /* Capabilities. */
            // 'capabilities' => array(

            //     // meta caps (don't assign these to roles)
            //     'edit_post'              => 'edit_department',
            //     'read_post'              => 'read_department',
            //     'delete_post'            => 'delete_department',

            //     // primitive/meta caps
            //     'create_posts'           => 'create_departments',

            //     // primitive caps used outside of map_meta_cap()
            //     'edit_posts'             => 'edit_departments',
            //     'edit_others_posts'      => 'manage_departments',
            //     'publish_posts'          => 'manage_departments',
            //     'read_private_posts'     => 'read',

            //     // primitive caps used inside of map_meta_cap()
            //     'read'                   => 'read',
            //     'delete_posts'           => 'manage_departments',
            //     'delete_private_posts'   => 'manage_departments',
            //     'delete_published_posts' => 'manage_departments',
            //     'delete_others_posts'    => 'manage_departments',
            //     'edit_private_posts'     => 'edit_departments',
            //     'edit_published_posts'   => 'edit_departments'
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'       => 'departments',
                'with_front' => false,
                'pages'      => true,
                'feeds'      => true,
                'ep_mask'    => EP_PERMALINK,
            ),

            /* What features the post type supports. */
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail'
            ),

            /* Taxonomies of the post type. */
            'taxonomies'  => array( 
                'agency' 
            ),

            /* Labels used when displaying the posts. */
            'labels' => array(
                'name'               => __( 'Departments',                   'hybrid-base' ),
                'singular_name'      => __( 'Department',                    'hybrid-base' ),
                'menu_name'          => __( 'Departments',                   'hybrid-base' ),
                'name_admin_bar'     => __( 'Department',                    'hybrid-base' ),
                'add_new'            => __( 'Add New',                     'hybrid-base' ),
                'add_new_item'       => __( 'Add New Department',            'hybrid-base' ),
                'edit_item'          => __( 'Edit Department',               'hybrid-base' ),
                'new_item'           => __( 'New Department',                'hybrid-base' ),
                'view_item'          => __( 'View Department',               'hybrid-base' ),
                'search_items'       => __( 'Search Departments',            'hybrid-base' ),
                'not_found'          => __( 'No departments found',          'hybrid-base' ),
                'not_found_in_trash' => __( 'No departments found in trash', 'hybrid-base' ),
                'all_items'          => __( 'Departments',                   'hybrid-base' ),
            )
        )
    );
}

/**
 * Custom "enter title here" text.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $title
 * @param  object  $post
 * @return string
 */
function department_enter_title_here( $title, $post ) {

    if ( 'department' === $post->post_type )
        $title = __( 'Name to be displayed on the website', 'directory' );

    return $title;
}