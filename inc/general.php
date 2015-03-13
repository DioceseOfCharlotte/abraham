<?php
/**
 * Register menus, sidebars, scripts and styles.
 *
 * @package Abraham
 */

add_filter( 'excerpt_more', 'abraham_excerpt_more' );

add_filter( 'the_excerpt',    'abraham_the_excerpt', 5 );

/* Add a custom excerpt length. */
add_filter( 'excerpt_length', 'abraham_excerpt_length' );

/* Conditional classes based on the number of widgets. */
add_filter( 'hybrid_attr_sidebar', 'abraham_footer_widgets_class', 10, 2 );

/* Custom search form. */
add_filter( 'get_search_form', 'abraham_search_form' );


function abraham_excerpt_more( $more ) {
	return ' &hellip; ';
}

function abraham_the_excerpt( $excerpt ) {
	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( __( 'Continue reading %s', 'saga' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	$more = sprintf( '<div class="read-more__fade"><a href="%s" class="more-link">%s</a></div>', get_permalink(), $text );
	return $excerpt . $more;
}

function abraham_excerpt_length( $length ) {
	return 40;
}

function abraham_footer_widgets_class( $attr, $context ) {
	if ( 'footer' === $context ) {
		global $sidebars_widgets;
		if ( is_array( $sidebars_widgets ) && !empty( $sidebars_widgets[ $context ] ) ) {
			$count = count( $sidebars_widgets[ $context ] );
			if ( 1 === $count )
				$attr['class'] .= ' sidebar-col-1';
			elseif ( !( $count % 3 ) || $count % 2 )
				$attr['class'] .= ' sidebar-col-3';
			elseif ( !( $count % 2 ) )
				$attr['class'] .= ' sidebar-col-2';
		}
	}
	return $attr;
}

function abraham_search_form( $form ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( '&#xf002;', 'submit button' ) .'" />
			</form>';

	return $form;
}



add_filter( 'hybrid_comment_template_hierarchy', 'abe_comment_template_hierarchy' );

function abe_comment_template_hierarchy( $templates ) {


		$templates = array_merge( [ 'partials/comment.php' ], $templates );

	return $templates;
}
