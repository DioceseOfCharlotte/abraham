<?php
add_action( 'init', 'archive_width_taxonomy' );


function get_archive_post_width($post = null) {
	if ( ! $post = get_post( $post ) )
		return false;

	$_width = get_the_terms( $post->ID, 'archive_post_width' );

	if ( empty( $_width ) )
		return false;

	$width = reset( $_width );
		return $width->slug;
}

// Register Width Taxonomy
function archive_width_taxonomy() {

	register_taxonomy( 'archive_post_width',
		abe_non_hierarchy_cpts(),
		array(
		'public'       => true,
		'hierarchical' => false,
		'labels'       => array(
			'name'          => _x( 'Width', 'post width' ),
			'singular_name' => _x( 'Width', 'post width' ),
		),
		'query_var'         => true,
		'show_admin_column' => true,
		//'rewrite' => false,
		'show_ui' => true,
		'show_in_nav_menus' => false,

		/* Capabilities. */
		'capabilities' => array(
			'manage_terms' => 'manage_options',
			'edit_terms'   => 'manage_options',
			'delete_terms' => 'manage_options',
			'assign_terms' => 'edit_posts',
		),
	) );
}
