<?php
/**
 * Register menus, sidebars, scripts and styles.
 *
 * @package Abraham
 */

add_filter( 'excerpt_more', 'abraham_excerpt_more' );

/* Add a custom excerpt length. */
add_filter( 'excerpt_length', 'abraham_excerpt_length' );

/* Conditional classes based on the number of widgets. */
add_filter( 'hybrid_attr_sidebar', 'abraham_footer_widgets_class', 10, 2 );

/* Custom search form. */
add_filter( 'get_search_form', 'abraham_search_form' );


function abraham_excerpt_more( $more ) {
	return '... <div class="read-more__fade"><a href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading...', 'abraham') . '</a></div>';
}

function abraham_excerpt_length( $length ) {
	return 80;
}

function abraham_footer_widgets_class( $attr, $context ) {
	if ( 'footer-widgets' === $context ) {
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

