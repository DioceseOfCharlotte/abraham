<?php
/**
 * Register menus, sidebars, scripts and styles.
 *
 * @package Abraham
 */

/* Add a custom read-more link. */
add_filter( 'the_excerpt',    'abraham_the_excerpt', 5 );

/* Add a custom excerpt length. */
add_filter( 'excerpt_length', 'abraham_excerpt_length' );




function abraham_the_excerpt( $excerpt ) {
	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Continue reading %s', 'saga' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	$more = sprintf( '<div class="read-more__fade"><a href="%s" class="more-link">%s</a></div>', get_permalink(), $text );
	return $excerpt . $more;
}




function abraham_excerpt_length( $length ) {
	return 40;
}



add_filter( 'hybrid_comment_template_hierarchy', 'abe_comment_template_hierarchy' );

function abe_comment_template_hierarchy( $templates ) {


		$templates = array_merge( [ 'partials/comment.php' ], $templates );

	return $templates;
}
