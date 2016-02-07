<?php
add_action( 'init', 'archive_width_taxonomy' );
add_action( 'after_switch_theme', 'archive_width_defaults' );


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

	register_extended_taxonomy( 'archive_post_width', abe_non_hierarchy_cpts(),
	array(

	    'meta_box' => false,
		//'exclusive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => false,
		// 'public'            => true,
		// 'show_ui'           => true,

		'capabilities' => array(
			'manage_terms' => 'manage_options',
			'edit_terms'   => 'manage_options',
			'delete_terms' => 'manage_options',
			'assign_terms' => 'edit_posts',
		),
	), array(

	    # Override the base names used for labels:
	    'singular' => 'Width',
	    'plural'   => 'Width',
	    'slug'     => 'width'

	) );
}

// Set default widths
if ( ! function_exists( 'archive_width_defaults' ) ) {

	function archive_width_defaults() {
		wp_insert_term(
		'100%', // the term
	    'archive_post_width', // the taxonomy
	    array(
	      'description'=> 'Full width',
	      'slug' => 'u-1of1'
			)
		);
		wp_insert_term(
		'1/4',
	    'archive_post_width',
	    array(
	      'description'=> '1/4 width',
	      'slug' => 'u-1of4-md'
			)
		);
		wp_insert_term(
		'1/3',
	    'archive_post_width',
	    array(
	      'description'=> '1/3 width',
	      'slug' => 'u-1of3-md'
			)
		);
		wp_insert_term(
		'1/2',
	    'archive_post_width',
	    array(
	      'description'=> '1/2 width',
	      'slug' => 'u-1of2-md'
			)
		);
		wp_insert_term(
		'2/3',
	    'archive_post_width',
	    array(
	      'description'=> '2/3 width',
	      'slug' => 'u-2of3-md'
			)
		);
		wp_insert_term(
		'3/4',
	    'archive_post_width',
	    array(
	      'description'=> '3/4 width',
	      'slug' => 'u-3of4-md'
			)
		);
	}
}
