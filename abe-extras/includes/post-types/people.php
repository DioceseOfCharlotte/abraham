<?php
/**
 * File for registering custom post types.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register custom post types on the 'init' hook. */
add_action( 'init', 'doc_people_register_post_types' );

/* Filter the "enter title here" text. */
add_filter( 'enter_title_here', 'people_enter_title_here', 10, 2 );



function doc_people_register_post_types() {

	/* Register the People post type. */

	register_post_type(
		'people',
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
			'menu_icon'           => 'dashicons-id',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => 'people',
			'query_var'           => 'people',
			'capability_type'     => 'page',
			'map_meta_cap'        => true,

			/* Capabilities. */
			// 'capabilities' => array(

			//     // meta caps (don't assign these to roles)
			//     'edit_post'              => 'edit_people',
			//     'read_post'              => 'read_people',
			//     'delete_post'            => 'delete_people',

			//     // primitive/meta caps
			//     'create_posts'           => 'create_people',

			//     // primitive caps used outside of map_meta_cap()
			//     'edit_posts'             => 'edit_people',
			//     'edit_others_posts'      => 'manage_people',
			//     'publish_posts'          => 'manage_people',
			//     'read_private_posts'     => 'read',

			//     // primitive caps used inside of map_meta_cap()
			//     'read'                   => 'read',
			//     'delete_posts'           => 'manage_people',
			//     'delete_private_posts'   => 'manage_people',
			//     'delete_published_posts' => 'manage_people',
			//     'delete_others_posts'    => 'manage_people',
			//     'edit_private_posts'     => 'edit_people',
			//     'edit_published_posts'   => 'edit_people'
			// ),

			/* The rewrite handles the URL structure. */
			'rewrite' => array(
				'slug'       => 'people',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
				'ep_mask'    => EP_PERMALINK,
			),

			/* What features the post type supports. */
			'supports' => array(
				'title',
				//'editor',
				'author',
				'thumbnail'
			),

			/* Taxonomies of the post type. */
			// 'taxonomies'  => array(
			//     'department'
			// ),

			/* Labels used when displaying the posts. */
			'labels' => array(
				'name'               => __( 'People',                   'hybrid-base' ),
				'singular_name'      => __( 'Person',                    'hybrid-base' ),
				'menu_name'          => __( 'People',                   'hybrid-base' ),
				'name_admin_bar'     => __( 'Person',                    'hybrid-base' ),
				'add_new'            => __( 'Add New',                     'hybrid-base' ),
				'add_new_item'       => __( 'Add New Person',            'hybrid-base' ),
				'edit_item'          => __( 'Edit Person',               'hybrid-base' ),
				'new_item'           => __( 'New Person',                'hybrid-base' ),
				'view_item'          => __( 'View Person',               'hybrid-base' ),
				'search_items'       => __( 'Search People',            'hybrid-base' ),
				'not_found'          => __( 'No people found',          'hybrid-base' ),
				'not_found_in_trash' => __( 'No people found in trash', 'hybrid-base' ),
				'all_items'          => __( 'People',                   'hybrid-base' ),
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
function people_enter_title_here( $title, $post ) {

	if ( 'people' === $post->post_type || 'department' === $post->post_type )
		$title = __( 'Name to be displayed on the website', 'directory' );

	return $title;
}








if ( ! function_exists( 'contact_type_taxonomy' ) ) {

// Register Custom Taxonomy
function contact_type_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Contact Types', 'Taxonomy General Name', 'abraham' ),
		'singular_name'              => _x( 'Contact Type', 'Taxonomy Singular Name', 'abraham' ),
		'menu_name'                  => __( 'Contact Type', 'abraham' ),
		'all_items'                  => __( 'All types', 'abraham' ),
		'parent_item'                => __( 'Parent type', 'abraham' ),
		'parent_item_colon'          => __( 'Parent type:', 'abraham' ),
		'new_item_name'              => __( 'New type Name', 'abraham' ),
		'add_new_item'               => __( 'Add New type', 'abraham' ),
		'edit_item'                  => __( 'Edit type', 'abraham' ),
		'update_item'                => __( 'Update type', 'abraham' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'abraham' ),
		'search_items'               => __( 'Search types', 'abraham' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'abraham' ),
		'choose_from_most_used'      => __( 'Choose from the most used types', 'abraham' ),
		'not_found'                  => __( 'Contact Type Not Found', 'abraham' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'contact_type', array( 'people' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'contact_type_taxonomy', 0 );

}