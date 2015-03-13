<?php
/**
 * Register scripts and styles.
 *
 * @package Abraham
 */


/* Custom scripts for the front-end. */
add_action( 'wp_enqueue_scripts', 'abraham_scripts', 5 );

/* Custom styles for the front-end. */
add_action( 'wp_enqueue_scripts', 'abraham_styles', 5 );

/* Styles for the editor. */
add_action( 'admin_init', 'abraham_add_editor_styles' );

/* Custom image sizes. */
add_action( 'init', 'abraham_image_sizes', 5 );




function abraham_scripts() {

	$suffix = hybrid_get_min_suffix();

	wp_enqueue_script( 'abraham-main', trailingslashit( get_template_directory_uri() ) . 'js/main.js', [], null, true );
}




function abraham_styles() {
	$parent_dir = trailingslashit( get_template_directory_uri() );
	$suffix = hybrid_get_min_suffix();

	wp_enqueue_style(
		'font-awesome',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'
	);

	wp_enqueue_style(
		'diocons',
		'//fontastic.s3.amazonaws.com/fPqC5US3TztqZdfynZTmYQ/icons.css'
	);

	wp_enqueue_style(
		'abraham-fonts',
		'//fonts.googleapis.com/css?family=Raleway:200,500,700,300|Roboto:500,400italic,300,700,300italic,400', [],	null
	);

	if ( is_child_theme() )
		wp_enqueue_style(
			'parent',
			$parent_dir . "style{$suffix}.css"
		);

	wp_enqueue_style(
		'style',
		get_stylesheet_uri()
	);
}




function abraham_add_editor_styles() {
	// Set up editor styles
	$editor_styles = [
		'//fonts.googleapis.com/css?family=Raleway:200,500,700,300|Roboto:500,400italic,300,700,300italic,400',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
		'//fontastic.s3.amazonaws.com/fPqC5US3TztqZdfynZTmYQ/icons.css',
		'css/editor-style.css',
	];

	// Add the editor styles.
	add_editor_style( $editor_styles );
}




function abraham_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size( 175, 130, true );

	// Add the 'abraham-full' image size.
	add_image_size( 'abraham-lg', 1100, 619, true );

	// Add the 'abraham-full' image size.
	add_image_size( 'abraham-md', 400, 225, true );
}
