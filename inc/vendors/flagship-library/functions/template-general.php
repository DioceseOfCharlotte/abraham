<?php
/**
 * General template helper functions.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.0.0
 */

add_action( 'wp_head', 'flagship_load_favicon', 5 );
/**
 * Echos a favicon link if one is found and falls back to the default Flagship
 * theme favicon when no custom one has been set.
 *
 * URL to favicon is filtered via `flagship_favicon_url` before being echoed.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function flagship_load_favicon() {
	$favicon = '';
	$path    = 'images/favicon.ico';

	// Fall back to the parent favicon if it exists.
	if ( file_exists( trailingslashit( get_template_directory() ) . $path ) ) {
		$favicon = trailingslashit( get_template_directory_uri() ) . $path;
	}
	// Use the child theme favicon if it exists.
	if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $path ) ) {
		$favicon = trailingslashit( get_stylesheet_directory_uri() ) . $path;
	}

	// Allow developers to set a custom favicon file.
	$favicon = apply_filters( 'flagship_favicon_url', $favicon );

	// Bail if we don't have a favicon to display.
	if ( empty( $favicon ) ) {
		return;
	}

	echo '<link rel="Shortcut Icon" href="' . esc_url( $favicon ) . '" type="image/x-icon" />' . "\n";
}

/**
 * Retrieve the site logo URL or ID (URL by default). Pass in the string
 * 'id' for ID.
 *
 * @since  1.1.0
 * @uses   Flagship_Site_Logo::get_flagship_logo
 * @param  string $format the format to return
 * @return mixed The URL or ID of our site logo, false if not set
 */
function flagship_get_logo( $format = 'url' ) {
	if ( ! class_exists( 'Flagship_Site_Logo', false ) ) {
		if ( function_exists( 'jetpack_the_site_logo' ) ) {
			return jetpack_get_site_logo( $format );
		}
		if ( function_exists( 'the_site_logo' ) ) {
			return get_site_logo( $format );
		}
		return null;
	}
	return flagship_library()->site_logo->get_flagship_logo( $format );
}

/**
 * Determine if a site logo is assigned or not.
 *
 * @since  1.1.0
 * @uses   Flagship_Site_Logo::has_site_logo
 * @return boolean True if there is an active logo, false otherwise
 */
function flagship_has_logo() {
	if ( ! class_exists( 'Flagship_Site_Logo', false ) ) {
		if ( function_exists( 'jetpack_the_site_logo' ) ) {
			return jetpack_has_site_logo();
		}
		if ( function_exists( 'the_site_logo' ) ) {
			return has_site_logo();
		}
		return null;
	}
	return flagship_library()->site_logo->has_site_logo();
}

/**
 * Output an <img> tag of the site logo, at the size specified
 * in the theme's add_theme_support() declaration.
 *
 * @since  1.1.0
 * @uses   Flagship_Site_Logo::the_site_logo
 * @return void
 */
function flagship_the_logo() {
	if ( ! class_exists( 'Flagship_Site_Logo', false ) ) {
		if ( function_exists( 'jetpack_the_site_logo' ) ) {
			jetpack_the_site_logo();
			return;
		}
		if ( function_exists( 'the_site_logo' ) ) {
			the_site_logo();
			return;
		}
		return;
	}
	flagship_library()->site_logo->the_site_logo();
}

/**
 * Sets a common class, `.nav-menu`, for the custom menu widget if used as part
 * of a site navigation element.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Header menu args.
 * @return array $args Modified header menu args.
 */
function flagship_widget_menu_args( $args ) {
	$args['menu_class'] .= ' nav-menu';
	return $args;
}

/**
 * Wrap the header navigation menu in its own nav tags with markup API.
 *
 * @since  1.0.0
 * @access public
 * @param  $menu Menu output.
 * @return string $menu Modified menu output.
 */
function flagship_widget_menu_wrap( $menu, $context = '' ) {
	return sprintf( '<nav %s>', hybrid_get_attr( 'menu', $context ) ) . $menu . '</nav>';
}

/**
 * Wrap the header navigation menu in its own nav tags with markup API.
 *
 * @since  1.0.0
 * @access public
 * @param  $menu Menu output.
 * @return string $menu Modified menu output.
 */
function flagship_header_menu_wrap( $menu ) {
	return flagship_widget_menu_wrap( $menu, 'header' );
}

add_filter( 'get_search_form', 'flagship_get_search_form' );
/**
 * Customize the search form to improve accessibility.
 *
 * @since  1.0.0
 * @access public
 * @return string Search form markup.
 */
function flagship_get_search_form() {
	$search = new Flagship_Search_Form;
	return $search->get_form();
}

/**
 * Display our breadcrumbs based on selections made in the WordPress customizer.
 *
 * @since  1.1.0
 * @access public
 * @return bool true if both our template tag and theme mod return true.
 */
function flagship_display_breadcrumbs() {
	$breadcrumbs = flagship_library()->breadcrumb_display;
	// Return early if our theme doesn't support breadcrumbs.
	if ( ! is_object( $breadcrumbs ) ) {
		return false;
	}
	// Grab our available breadcrumb display options.
	$options = array_keys( $breadcrumbs->get_options() );
	// Set up an array of template tags to map to our breadcrumb display options.
	$tags = apply_filters( 'flagship_breadcrumb_tags',
		array(
			is_singular() && ! is_attachment() && ! is_page(),
			is_page(),
			is_home() && ! is_front_page(),
			is_archive(),
			is_404(),
			is_attachment(),
		)
	);

	// Loop through our theme mods to see if we have a match.
	foreach ( array_combine( $options, $tags ) as $mod => $tag ) {
		// Return true if we find an enabled theme mod within the correct section.
		if ( 1 === absint( get_theme_mod( $mod, 0 ) ) && true === $tag ) {
			return true;
		}
	}
	return false;
}

/**
 * Outputs a navigation element for a singular entry.
 *
 * @since  1.3.0
 * @access public
 * @param  $args array
 * @return void
 */
function flagship_post_navigation( $args = array() ) {
	echo flagship_get_post_navigation( $args );
}

/**
 * Helper function to build a next and previous post navigation element on
 * single entries. This takes care of all the annoying formatting which usually
 * would need to be done within a template.
 *
 * I originally wanted to use the new get_the_post_navigation tag for this;
 * however, it's lacking a lot of the flexibility provided by using the old
 * template tags directly. Until WordPress core gets its act together, I guess
 * I'll just have to duplicate code for no good reason.
 *
 * @since  1.3.0
 * @access public
 * @param  $args array
 * @return string
 */
function flagship_get_post_navigation( $args = array() ) {
	$obj  = get_post_type_object( get_post_type() );
	$name = isset( $obj->labels->singular_name ) ? '&nbsp;' . $obj->labels->singular_name : '';

	$defaults = apply_filters( 'flagship_get_post_navigation_defaults',
		array(
			'post_types'     => array(),
			'prev_format'    => '<span class="nav-previous">%link</span>',
			'next_format'    => '<span class="nav-next">%link</span>',
			'prev_text'      => __( 'Previous', 'flagship-library' ) . esc_attr( $name ),
			'next_text'      => __( 'Next', 'flagship-library' ) . esc_attr( $name ),
			'in_same_term'   => false,
			'excluded_terms' => '',
			'taxonomy'       => 'category',
		)
	);

	$args = wp_parse_args( $args, $defaults );

	// Bail if we're not on a single entry. All post types are allowed by default.
	if ( ! is_singular( $args['post_types'] ) ) {
		return;
	}

	$links = '';
	// Previous post link. Can be filtered via WP Core's previous_post_link filter.
	$links .= get_adjacent_post_link(
		$args['prev_format'],
		$args['prev_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		true,
		$args['taxonomy']
	);
	// Next post link. Can be filtered via WP Core's next_post_link filter.
	$links .= get_adjacent_post_link(
		$args['next_format'],
		$args['next_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		false,
		$args['taxonomy']
	);

	// Bail if we don't have any posts to link to.
	if ( empty( $links ) ) {
		return;
	}

	$output = '';

	$output .= '<nav ' . hybrid_get_attr( 'nav', 'single' ) . '>';
	$output .= $links;
	$output .= '</nav><!-- .nav-single -->';

	return $output;
}

/**
 * Outputs a navigation element for a loop.
 *
 * @since  1.3.0
 * @access public
 * @param  $args array
 * @return void
 */
function flagship_posts_navigation( $args = array() ) {
	echo flagship_get_posts_navigation( $args );
}

/**
 * Helper function to build a newer/older or paginated navigation element within
 * a loop of multiple entries. This takes care of all the annoying formatting
 * which usually would need to be done within a template.
 *
 * This defaults to a pagination format unless the site is using a version of
 * WordPress older than 4.1. For older sites, we fall back to the next and
 * previous post links by default.
 *
 * @since  1.3.0
 * @access public
 * @param  $args array
 * @return string
 */
function flagship_get_posts_navigation( $args = array() ) {
	global $wp_query;
	// Return early if we're on a singular post or we only have one page.
	if ( is_singular() || 1 === $wp_query->max_num_pages ) {
		return;
	}

	$defaults = apply_filters( 'flagship_loop_nav_defaults',
		array(
			'format'         => 'pagination',
			'prev_text'      => sprintf( '<span class="screen-reader-text">%s</span>' , __( 'Previous Page', 'flagship-library' ) ),
			'next_text'      => sprintf( '<span class="screen-reader-text">%s</span>', __( 'Next Page', 'flagship-library' ) ),
			'prev_link_text' => __( 'Newer Posts', 'flagship-library' ),
			'next_link_text' => __( 'Older Posts', 'flagship-library' ),
		)
	);

	$args = wp_parse_args( $args, $defaults );

	$output = '';

	$output .= '<nav ' . hybrid_get_attr( 'nav', 'archive' ) . '>';
	$output .= sprintf( '<span class="nav-previous">%s</span>', get_previous_posts_link( $args['prev_link_text'] ) );
	$output .= sprintf( '<span class="nav-next">%s</span>', get_next_posts_link( $args['next_link_text'] ) );
	$output .= '</nav><!-- .nav-archive -->';

	if ( function_exists( 'the_posts_pagination' ) && 'pagination' === $args['format'] ) {
		$output = get_the_posts_pagination(
			array(
				'prev_text' => $args['prev_text'],
				'next_text' => $args['next_text'],
			)
		);
	}

	return apply_filters( 'flagship_loop_nav', $output, $args );
}

/**
 * Display a link to the customizer panel.
 *
 * @since  1.4.0
 * @access public
 * @param  $args array options for how the link will be formatted
 * @return void
 */
function flagship_customizer_link( $args = array() ) {
	echo flagship_get_customizer_link( $args );
}

/**
 * Format a link to the customizer panel.
 *
 * Since WordPress 4.1, the customizer panel allows for deeplinking, but setting
 * up a link can be rather tedious. This function wraps the query args required
 * to deep link to a customzer panel or control, plus return to the correct page
 * when the customizer is exited by the user.
 *
 * @since  1.4.0
 * @access public
 * @param  $args array options for how the link will be formatted
 * @return string an escaped link to the WordPress customizer panel.
 */
function flagship_get_customizer_link( $args = array() ) {
	$defaults = array(
		'focus_type'   => 'panel',
		'focus_target' => 'widgets',
		'return'       => get_permalink(),
	);

	$args = wp_parse_args( $args, $defaults );

	$query_args = array();
	$type       = $args['focus_type'];
	$target     = $args['focus_target'];
	$return     = $args['return'];

	if ( ! empty( $type ) && ! empty( $target ) ) {
		$query_args[] = array( 'autofocus' => array( $type => $target, ), );
	}
	if ( ! empty( $return ) ) {
		$query_args['return'] = urlencode( wp_unslash( $return ) );
	}

	return esc_url( add_query_arg( $query_args, admin_url( 'customize.php' ) ) );
}

/**
 * Returns a formatted theme credit link.
 *
 * @since  1.1.0
 * @access public
 * @return string
 */
function flagship_credit_link() {
	echo flagship_get_credit_link();
}

/**
 * Returns a formatted theme credit link.
 *
 * @since  1.1.0
 * @access public
 * @return string
 */
function flagship_get_credit_link() {
	$link = sprintf( '<a class="author-link" href="%s" title="%s">%s</a>',
		'https://flagshipwp.com',
		__( 'Purpose-Built WordPress Theme by', 'flagship-library' ) . ' Flagship',
		'Flagship'
	);
	return apply_filters( 'flagship_credit_link', $link );
}
