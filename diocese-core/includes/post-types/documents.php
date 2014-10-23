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
add_action( 'init', 'doc_documents_register_post_types' );

function doc_documents_register_post_types() {

    /* Register the Document post type. */

    register_post_type(
        'document',
        array(
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => 'documents',
            'query_var'           => 'document',
            'capability_type'     => 'page',
            'map_meta_cap'        => true,

            /* Capabilities. */
            // 'capabilities' => array(

            //     // meta caps (don't assign these to roles)
            //     'edit_post'              => 'edit_document',
            //     'read_post'              => 'read_document',
            //     'delete_post'            => 'delete_document',

            //     // primitive/meta caps
            //     'create_posts'           => 'create_documents',

            //     // primitive caps used outside of map_meta_cap()
            //     'edit_posts'             => 'edit_documents',
            //     'edit_others_posts'      => 'manage_documents',
            //     'publish_posts'          => 'manage_documents',
            //     'read_private_posts'     => 'read',

            //     // primitive caps used inside of map_meta_cap()
            //     'read'                   => 'read',
            //     'delete_posts'           => 'manage_documents',
            //     'delete_private_posts'   => 'manage_documents',
            //     'delete_published_posts' => 'manage_documents',
            //     'delete_others_posts'    => 'manage_documents',
            //     'edit_private_posts'     => 'edit_documents',
            //     'edit_published_posts'   => 'edit_documents'
            // ),

            /* The rewrite handles the URL structure. */
            'rewrite' => array(
                'slug'       => 'documents',
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
                'name'               => __( 'Documents',                   'hybrid-base' ),
                'singular_name'      => __( 'Document',                    'hybrid-base' ),
                'menu_name'          => __( 'Documents',                   'hybrid-base' ),
                'name_admin_bar'     => __( 'Document',                    'hybrid-base' ),
                'add_new'            => __( 'Add New',                     'hybrid-base' ),
                'add_new_item'       => __( 'Add New Document',            'hybrid-base' ),
                'edit_item'          => __( 'Edit Document',               'hybrid-base' ),
                'new_item'           => __( 'New Document',                'hybrid-base' ),
                'view_item'          => __( 'View Document',               'hybrid-base' ),
                'search_items'       => __( 'Search Documents',            'hybrid-base' ),
                'not_found'          => __( 'No documents found',          'hybrid-base' ),
                'not_found_in_trash' => __( 'No documents found in trash', 'hybrid-base' ),
                'all_items'          => __( 'Documents',                   'hybrid-base' ),
            )
        )
    );
}
