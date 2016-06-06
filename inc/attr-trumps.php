<?php
/**
 * Overwrite html class selectors.
 *
 * @package Abraham
 */

/**
 * Overwrite html class selectors.
 *
 * @param  array $args Arguments to pass to hybrid_attr.
 */
function attr_trumps( $args = array() ) {

	if ( is_admin() )
		return;

	$trump = apply_filters( 'attr_trumps_object', null, $args );
	if ( ! is_object( $trump ) ) {
		$trump = new Attr_Trumps( $args ); }
}

/**
 * Add class selectors to hybrid attributes.
 */
class Attr_Trumps {

	/**
	 * @since  0.1.0
	 * @access public
	 * @var    array
	 */
	public $args = array();

	/**
	 * Filter hybrid attributes.
	 */
	public function __construct( $args = array() ) {

		$defaults = array(
			'body'                   	  => '',
			'site_container'         	  => '',
			'layout'                 	  => '',
			'layout_wide'            	  => '',
			'grid'                   	  => 'o-grid u-container  u-rel',
			'grid_1-wide'               => 'o-grid u-1of1  u-rel u-p0',
			'grid_2c-r'                 => 'o-grid u-container  u-rel u-flex-rev',
			'grid_2c-l'                 => 'o-grid u-container u-rel',

			// SITE HEADER.
			'header'              		   => 'u-abs is-top animating u-bg-1-glass u-1of1 u-z3 u-flex u-flex-wrap u-flex-center',
			'branding'            		   => '',
			'site_title'          		   => 'u-heading u-color-inherit u-m0',
			'site_description'        	   => 'u-heading u-m0 u-text-3',
			// CONTENT.
			'content'                 	=> 'o-cell o-grid u-m0 u-p0 u-1of1',
			'content_with_sidebar'    	=> 'o-cell o-grid u-m0 u-p0 u-1of1 u-2of3-md',
			'content_archive'         	=> 'u-flex u-flex-ja',

			'page_header'             	=> 'u-p4 u-1of1 u-rel u-text-center',
			'page_title'              	=> 'u-text-shadow u-h0 u-m0 u-pb1',
			'archive_description'     	=> 'u-1of1 u-p2 u-p4-md u-text-left u-br u-container u-mb2 u-mb3-md u-bg-white u-rel u-shadow2',

			// ENTRY.
			'post'                    	=> 'u-fit o-cell u-bg-white u-mb3 u-1of1 u-br u-shadow2',
			'post_wide'               	=> 'u-fit u-1of1',

			'post_archive'            	=> 'o-cell u-flexed-auto u-1of2-md u-1of3-xl u-bg-white u-overflow-hidden u-shadow1 u-br',
			'entry_header'            	=> 'u-z1',
			'entry_title'             	=> 'u-px2 u-h3 u-flexed-auto',
			'entry_content'           	=> 'u-p2 u-p4-md',
			'entry_content_wide'      	=> '',
			'entry_summary'           	=> 'u-p2 u-p3-md',
			'entry_footer'            	=> 'u-mt-auto',

			'nav_single'              	=> '',
			'nav_archive'             	=> '',

			// ENTRY META.
			'entry_author'            	=> '',
			'entry_published'         	=> '',
			'entry_terms'             	=> '',

			// NAVIGATION.
			'menu_all'                	=> '',
			'menu_primary'            	=> 'u-z2 u-mx-auto-md u-text-center u-1of1 u-bg-1 u-width-auto-lg',
			'menu_secondary'          	=> '',

			// SIDEBAR.
			'sidebar_primary'         	=> 'o-cell o-grid u-bg-white u-shadow2 u-p1 u-mb3 u-br',
			'sidebar_footer'          	=> 'o-grid u-pt3 u-container-wide',
			'sidebar_horizontal'      	=> 'u-1of1',
			'sidebar_right'           	=> 'u-1of1 u-1of3-md',
			'sidebar_left'            	=> 'u-1of1 u-1of3-md',
			'widgets'                 	=> '',
			'primary_widgets'         	=> '',
			'footer_widgets'          	=> '',

			// COMMENTS.
			'comments_area'           	=> 'u-p3',

			// FOOTER.
			'footer'                    => 'u-mt-auto u-bg-2',
			'menu_item'                 => '',
			'menu_link'                 => 'menu__link btn u-1of1 u-text-left u-br0',
			'current_page_item'         => 'is-active',
			'current_page_parent'       => 'is-active',
			'current_page_ancestor'     => 'is-active',
			'current-menu-item'         => 'is-active',
			'menu-item-has-children'    => '',
			'sub-menu'                  => '',
			'gv_post'                   => 'u-bg-transparent u-shadow0',
			'gv_container'              => 'o-grid',
			'gv_entry'                  => 'o-cell u-1of1 u-p1 u-br u-bg-white u-rel u-1of2-md u-1of3-lg u-border0 u-shadow1',
		);

		$this->args = apply_filters( 'attr_trumps_args', wp_parse_args( $args, $defaults ) );

		// CONTAINERS.
		add_filter( 'hybrid_attr_body',                  array( $this, 'body' ) );
		add_filter( 'hybrid_attr_site_container',        array( $this, 'site_container' ) );
		add_filter( 'hybrid_attr_layout',                array( $this, 'layout' ) );
		add_filter( 'hybrid_attr_grid',                  array( $this, 'grid' ) );

		// SITE HEADER.
		add_filter( 'hybrid_attr_header',                array( $this, 'header' ) );
		add_filter( 'hybrid_attr_branding',              array( $this, 'branding' ) );
		add_filter( 'hybrid_attr_site-title',            array( $this, 'site_title' ) );
		add_filter( 'hybrid_attr_site-description',      array( $this, 'site_description' ) );

		// CONTENT.
		add_filter( 'hybrid_attr_content',               array( $this, 'content' ) );

		// ENTRY.
		add_filter( 'post_class',                        array( $this, 'post' ), 10, 3 );
		add_filter( 'hybrid_attr_archive-header',        array( $this, 'page_header' ) );
		add_filter( 'hybrid_attr_archive-title',         array( $this, 'page_title' ) );
		add_filter( 'hybrid_attr_archive-description',   array( $this, 'archive_description' ) );
		add_filter( 'hybrid_attr_entry-header',          array( $this, 'entry_header' ) );
		add_filter( 'hybrid_attr_entry-title',           array( $this, 'entry_title' ) );
		add_filter( 'hybrid_attr_entry-content',         array( $this, 'entry_content' ) );
		add_filter( 'hybrid_attr_entry-summary',         array( $this, 'entry_summary' ) );
		add_filter( 'hybrid_attr_entry-footer',          array( $this, 'entry_footer' ) );

		// ENTRY META.
		add_filter( 'hybrid_attr_entry-author',          array( $this, 'entry_author' ) );
		add_filter( 'hybrid_attr_entry-published',       array( $this, 'entry_published' ) );
		add_filter( 'hybrid_attr_entry-terms',           array( $this, 'entry_terms' ) );

		// NAVIGATION.
		add_filter( 'hybrid_attr_menu',                  array( $this, 'menu' ), 10, 2 );

		// SIDEBAR.
		add_filter( 'hybrid_attr_sidebar',               array( $this, 'sidebar' ), 10, 2 );
		add_filter( 'hybrid_attr_widgets',               array( $this, 'widgets' ), 10, 2 );

		// FOOTER.
		add_filter( 'hybrid_attr_footer',                array( $this, 'footer' ) );

		// COMMENTS.
		add_filter( 'hybrid_attr_comments-area',         array( $this, 'comments_area' ) );

		add_filter( 'nav_menu_link_attributes',          array( $this, 'menu_link' ), 10, 3 );

		add_filter( 'wp_nav_menu',                       array( $this, 'nav_menu_filters' ) );
		add_filter( 'nav_menu_css_class',                array( $this, 'menu_item' ), 10, 2 );

		add_filter( 'gravityview/render/container/class',            array( $this, 'gv_container' ), 10, 1 );
		add_filter( 'gravityview_entry_class',                       array( $this, 'gv_entry' ), 10, 3 );
	}

	/* === OBJECTS === */

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function body( $attr ) {
		if ( ! $this->args['body'] ) {
			return $attr;
		}
		$attr['class']      .= " {$this->args['body']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function site_container( $attr ) {
		$attr['id']        = 'page';
		$attr['class']     = 'site';

		if ( ! $this->args['site_container'] ) {
			return $attr;
		}

		$attr['class'] .= " {$this->args['site_container']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function layout( $attr ) {
		$attr['id']       = 'content';
		$attr['class']    = 'site-content';
		if ( ! $this->args['layout'] ) {
			return $attr;
		}

		if ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) ) :
			$attr['class']   .= " {$this->args['layout_wide']}";
			else :
				$attr['class']   .= " {$this->args['layout']}";
			endif;

			return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function grid( $attr ) {
		$attr['class']     = 'content-layout';
		if ( ! $this->args['grid'] ) {
			return $attr;
		}

		if ( 'sidebar-right' === hybrid_get_theme_layout( 'theme_layout' ) ) :
			$attr['class']      .= " {$this->args['grid_2c-l']}";
			elseif ( 'sidebar-left' === hybrid_get_theme_layout( 'theme_layout' ) ) :
				$attr['class']      .= " {$this->args['grid_2c-r']}";
				elseif ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) ) :
					$attr['class']      .= " {$this->args['grid_1-wide']}";
					else :
						$attr['class']      .= " {$this->args['grid']}";
						endif;

					return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr Adds classes to hybrid_attr.
	 * @param  string $context A specific context (e.g., 'primary').
	 */
	public function nav( $attr, $context ) {

		if ( 'single' === $context ) {
			$attr['class']      .= " {$this->args['nav_single']}";
		}
		if ( 'archive' === $context ) {
			$attr['class']      .= " {$this->args['nav_archive']}";
		}
		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function comments_area( $attr ) {
		if ( ! $this->args['comments_area'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['comments_area']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function header( $attr ) {
		if ( ! $this->args['header'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['header']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function footer( $attr ) {
		if ( ! $this->args['footer'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['footer']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function content( $attr ) {
		$attr['id']       = 'main';
		$attr['class']    = 'site-main';

		if ( ! $this->args['content'] ) {
			return $attr;
		}

		if ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) ) :
			$attr['class']      .= " {$this->args['content']}";

			elseif ( '1-column' === hybrid_get_theme_layout( 'theme_layout' ) ) :
				$attr['class']      .= " {$this->args['content']}";

				elseif ( 'sidebar-right' === hybrid_get_theme_layout( 'theme_layout' ) ) :
					$attr['class']      .= " {$this->args['content_with_sidebar']}";

					elseif ( 'sidebar-left' === hybrid_get_theme_layout( 'theme_layout' ) ) :
						$attr['class']      .= " {$this->args['content_with_sidebar']}";
					endif;

					if ( hybrid_is_plural() ) {
						$attr['class']      .= " {$this->args['content_archive']}";
					}
					if ( function_exists( 'doc_get_facet_cpts' ) && is_post_type_archive( doc_get_facet_cpts() ) ) {
						$attr['class']   .= ' facetwp-template';
					}

					return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr Adds classes to hybrid_attr.
	 * @param  string $context A specific context (e.g., 'primary').
	 */
	public function sidebar( $attr, $context ) {
		if ( empty( $context ) ) {
			return $attr;
		}

		if ( 'primary' === $context ) {

			if ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) ) :
				$attr['class']      .= " {$this->args['sidebar_horizontal']}";
				elseif ( '1-column' === hybrid_get_theme_layout( 'theme_layout' ) ) :
					$attr['class']      .= " {$this->args['sidebar_horizontal']}";
					elseif ( 'sidebar-right' === hybrid_get_theme_layout( 'theme_layout' ) ) :
						$attr['class']      .= " {$this->args['sidebar_right']}";
						elseif ( 'sidebar-left' === hybrid_get_theme_layout( 'theme_layout' ) ) :
							$attr['class']      .= " {$this->args['sidebar_left']}";
						endif;
						$attr['class']      .= " {$this->args['sidebar_primary']}";

		}
		if ( 'footer' === $context ) {
			$attr['class']      .= " {$this->args['sidebar_footer']}";
		}
		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr Adds classes to hybrid_attr.
	 * @param  string $context A specific context (e.g., 'primary').
	 */
	public function widgets( $attr, $context ) {
		if ( empty( $context ) ) {
			return $attr;
		}
		if ( $this->args['widgets'] ) {
			$attr['class']      = $this->args['widgets'];

			if ( 'footer' === $context ) {
				$attr['class']      .= " {$this->args['footer_widgets']}";
			}
			if ( 'primary' === $context ) {
				$attr['class']      .= " {$this->args['primary_widgets']}";
			}

			return $attr;
		}
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr Adds classes to hybrid_attr.
	 * @param  string $context A specific context (e.g., 'primary').
	 */
	public function menu( $attr, $context ) {
		if ( empty( $context ) ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['menu_all']}";

		if ( 'primary' === $context ) {
			$attr['class']      .= " {$this->args['menu_primary']}";
		}
		if ( 'secondary' === $context ) {
			$attr['class']      .= " {$this->args['menu_secondary']}";
		}
		return $attr;
	}

	/* === COMPONENTS === */

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function branding( $attr ) {
		if ( ! $this->args['branding'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['branding']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function site_title( $attr ) {
		if ( ! $this->args['site_title'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['site_title']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function site_description( $attr ) {
		if ( ! $this->args['site_description'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['site_description']}";

		return $attr;
	}

	/* === LOOP === */

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function page_header( $attr ) {
		if ( ! $this->args['page_header'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['page_header']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function page_title( $attr ) {
		if ( ! $this->args['page_title'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['page_title']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function archive_description( $attr ) {
		if ( ! $this->args['archive_description'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['archive_description']}";

		return $attr;
	}

	/* === POSTS === */

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $classes Adds classes to the post element.
	 * @param  array $class An optional post ID.
	 * @param  array $post_id An optional post ID.
	 */
	public function post( $classes, $class, $post_id ) {
		if ( is_admin() ) {
			return $classes; }

		if ( is_singular() && ! is_front_page() ) {
			is_single( $post_id ) || is_page() ? $classes[] = "{$this->args['post']}" : $classes[] = "{$this->args['post_archive']}";
		}

		if ( is_archive() || is_search() || is_home ) {
			$classes[]      = "{$this->args['post_archive']}"; }

		if ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) ) {
			$classes[]      = "{$this->args['post_wide']}"; }

		if ( is_singular( 'gravityview' ) && 'edit' !== gravityview_get_context() ) {
			$classes[]      = "{$this->args['gv_post']}"; }

		return $classes;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_title( $attr ) {
		if ( ! $this->args['entry_title'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_title']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_author( $attr ) {
		if ( ! $this->args['entry_author'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_author']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_published( $attr ) {
		if ( ! $this->args['entry_published'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_published']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_header( $attr ) {
		$attr['class']     = 'entry-header';
		if ( ! $this->args['entry_header'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_header']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_content( $attr ) {
		if ( ! $this->args['entry_content'] ) {
			return $attr;
		}

		if ( '1-column-wide' === hybrid_get_theme_layout( 'theme_layout' ) || is_singular( 'gravityview' ) && 'edit' !== gravityview_get_context() ) :
			$attr['class']      .= " {$this->args['entry_content_wide']}";
			else :
				$attr['class']      .= " {$this->args['entry_content']}";
			endif;

			return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_summary( $attr ) {
		if ( ! $this->args['entry_summary'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_summary']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_footer( $attr ) {
		$attr['class']     = 'entry-footer';
		if ( ! $this->args['entry_footer'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_footer']}";
		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_terms( $attr ) {
		if ( ! $this->args['entry_terms'] ) {
			return $attr;
		}

		$attr['class']      .= " {$this->args['entry_terms']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr The CSS classes that are applied to the menu item's <li> element.
	 * @param  object $item The current menu item.
	 */
	public function menu_item( $attr, $item ) {
		if ( ! $this->args['menu_item'] ) {
			return $attr;
		}

		$attr[] .= " {$this->args['menu_item']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array  $attr HTML attributes applied to menu item's <a> element.
	 * @param  object $item The current menu item.
	 * @param  array  $args An array of wp_nav_menu() arguments.
	 */
	public function menu_link( $attr, $item, $args ) {
		$attr['class'] = $this->args['menu_link'];
		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $text Adds classes to hybrid_attr.
	 * @return array
	 */
	public function nav_menu_filters( $text ) {
		$replace = array(
			'current_page_item'      => $this->args['current_page_item'],
			'current_page_parent'    => $this->args['current_page_parent'],
			'current_page_ancestor'  => $this->args['current_page_ancestor'],
			'current-menu-item'      => $this->args['current-menu-item'],
			'menu-item-has-children' => $this->args['menu-item-has-children'],
			'sub-menu'               => $this->args['sub-menu'],
		);
		$text = str_replace( array_keys( $replace ), $replace, $text );
		return $text;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function gv_container( $attr ) {
		if ( ! $this->args['gv_container'] ) {
			return $attr;
		}

		$attr     .= " {$this->args['gv_container']}";

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param string           $attr Existing class.
	 * @param array            $entry Current entry being displayed.
	 * @param GravityView_View $instance Current GravityView_View object.
	 */
	public function gv_entry( $attr, $entry, $instance ) {
		if ( ! $this->args['gv_entry'] ) {
			return $attr;
		}
		$attr     .= " {$this->args['gv_entry']}";

		return $attr;
	}
}

new Attr_Trumps();
