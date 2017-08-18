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
			'grid'                      => 'o-grid u-pt u-container u-rel',
			'grid_1-wide'               => 'o-grid u-pt u-1of1 u-rel u-p0',
			'grid_2c-r'                 => 'o-grid u-pt u-container u-rel u-flex-rev',
			'grid_2c-l'                 => 'o-grid u-pt u-container u-rel',

			// SITE HEADER.
			'header'                    => 'u-px1-md u-z2 is-top animating u-z1 u-bg-1 u-1of1 u-flex u-flex-wrap u-flex-center',
			'branding'                  => 'u-flexed-auto u-text-center u-mln1',
			'site_title'                => 'u-text-display u-h3 u-color-inherit u-p0',
			'site_description'          => 'u-text-display u-h4 u-p0 u-text-3',

			// CONTENT.
			'content'                   => 'o-cell o-grid u-m0 u-p0 u-1of1',
			'content_with_sidebar'      => 'o-cell o-grid u-m0 u-p0 u-1of1 u-2of3-md',
			'content_archive'           => 'u-flex u-flex-ja',

			'page_header'               => 'u-py u-1of1 u-rel u-text-shadow u-text-center',
			'page_title'                => 'u-h0 u-m0 u-text-display',
			'archive_description'       => 'u-1of1 u-p u-p2-md u-text-left u-br u-mb u-bg-white u-rel u-shadow2',

			// ENTRY.
			'post'                      => 'u-fit o-cell u-bg-white u-mb u-1of1 u-br u-shadow2',
			'post_wide'                 => 'u-fit u-1of1 u-m0 u-shadow0',

			'post_archive'              => 'o-cell u-shadow1 u-br',
			'entry_header'              => 'u-1of1',
			'entry_title'               => 'u-h3 u-flexed-auto u-text-display',
			'entry_content'             => 'u-p25',
			'entry_content_wide'        => '',
			'entry_summary'             => 'u-p u-pt1 show-icons',
			'entry_footer'              => 'u-mt-auto u-p1 u-pt0 u-rel u-1of1',

			// NAVIGATION.
			'menu_all'                  => '',
			'menu_primary'              => 'u-mx-auto-md u-bg-1 u-text-center',
			'menu_secondary'            => 'u-1of1',

			// SIDEBAR.
			'sidebar_primary'           => 'o-cell o-grid u-bg-white u-shadow2 u-p u-pb0 u-mb u-br',
			'sidebar_footer'            => 'o-grid u-pt u-container-wide',
			'sidebar_horizontal'        => 'u-1of1 u-flex-ja u-mx0',
			'sidebar_right'             => 'u-1of1 u-1of3-md u-flex-col',
			'sidebar_left'              => 'u-1of1 u-1of3-md u-flex-col',

			// COMMENTS. Same as post by default.
			'comments_area'             => 'u-p',

			// FOOTER.
			'footer'                    => 'u-mt-auto u-bg-2',
			'menu_item'                 => '',
			'menu_link'                 => 'menu__link btn u-1of1 u-text-left u-br0 u-flex u-flex-wrap u-flex-jb u-flex-center',
			'current_page_item'         => '',
			'current_page_parent'       => '',
			'current_page_ancestor'     => '',
			'current-menu-item'         => '',
			'menu-item-has-children'    => '',
			'sub-menu'                  => '',
		);

		$this->args = apply_filters( 'attr_trumps_args', wp_parse_args( $args, $defaults ) );

		// CONTAINERS.
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

		// NAVIGATION.
		add_filter( 'hybrid_attr_menu',                  array( $this, 'menu' ), 10, 2 );

		// SIDEBAR.
		add_filter( 'hybrid_attr_sidebar',               array( $this, 'sidebar' ), 10, 2 );

		// FOOTER.
		add_filter( 'hybrid_attr_footer',                array( $this, 'footer' ) );

		// COMMENTS.
		add_filter( 'hybrid_attr_comments_area',         array( $this, 'comments_area' ) );

		add_filter( 'nav_menu_link_attributes',          array( $this, 'menu_link' ), 10, 3 );

		add_filter( 'wp_nav_menu',                       array( $this, 'nav_menu_filters' ) );
		add_filter( 'nav_menu_css_class',                array( $this, 'menu_item' ), 10, 2 );

	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function grid( $attr ) {

		$attr['id']     = 'content';
		$attr['class']     = 'content-layout';
		if ( ! $this->args['grid'] ) {
			return $attr;
		}

		if ( abe_has_layout( 'sidebar-right' ) ) :
			$attr['class']      .= " {$this->args['grid_2c-l']}";
		elseif ( abe_has_layout( 'sidebar-left' ) ) :
			$attr['class']      .= " {$this->args['grid_2c-r']}";
		elseif ( abe_is_wide_layout() ) :
			$attr['class']      .= " {$this->args['grid_1-wide']}";
		else :
			$attr['class']      .= " {$this->args['grid']}";
		endif;

		return $attr;
	}


	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function comments_area( $attr ) {
		$attr['id']        = 'comments';
		$attr['class']     = 'comments-area';

		if ( $this->args['post'] && $this->args['entry_content'] ) {
			$attr['class']      .= " {$this->args['post']}";
			$attr['class']      .= " {$this->args['entry_content']}";
		}

		return $attr;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function header( $attr ) {

		$attr['id']        = 'header';
		$attr['class']     = 'site-header';
		$attr['itemscope'] = 'itemscope';
		$attr['itemtype']  = 'http://schema.org/WPHeader';

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

		$attr['id']        = 'footer';
		$attr['class']     = 'site-footer';
		$attr['itemscope'] = 'itemscope';
		$attr['itemtype']  = 'http://schema.org/WPFooter';

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
		if ( ! is_singular( 'post' ) && ! is_home() && ! is_archive() ) {
			$attr['itemprop'] = 'mainContentOfPage';
		}

		if ( ! $this->args['content'] ) {
			return $attr;
		}

		if ( abe_is_wide_layout() || abe_has_layout( '1-column' ) ) :
			$attr['class']      .= " {$this->args['content']}";

		elseif ( abe_has_layout( 'sidebar-right' ) ) :
			$attr['class']      .= " {$this->args['content_with_sidebar']}";

		elseif ( abe_has_layout( 'sidebar-left' ) ) :
			$attr['class']      .= " {$this->args['content_with_sidebar']}";

		endif;

		if ( hybrid_is_plural() ) {
			$attr['class']      .= " {$this->args['content_archive']}";
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

		$attr['class'] = 'sidebar';

		if ( empty( $context ) ) {
			return $attr;
		}

		$attr['class'] .= " sidebar-{$context}";
		$attr['id']     = "sidebar-{$context}";
		$sidebar_name = hybrid_get_sidebar_name( $context );
		if ( $sidebar_name ) {
			// Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'hybrid-core' ), $sidebar_name ) );
		}

		if ( 'primary' === $context ) {

			if ( abe_is_wide_layout() ||  abe_has_layout( '1-column' ) ) :
				$attr['class']      .= " {$this->args['sidebar_horizontal']}";
			elseif ( abe_has_layout( 'sidebar-right' ) ) :
				$attr['class']      .= " {$this->args['sidebar_right']}";
			elseif ( abe_has_layout( 'sidebar-left' ) ) :
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
	public function menu( $attr, $context ) {
		$attr['class'] = 'menu';

		$attr['itemscope']  = 'itemscope';
		$attr['itemtype']   = 'http://schema.org/SiteNavigationElement';

		if ( empty( $context ) ) {
			return $attr;
		}

		$attr['class'] .= " menu-{$context}";
		$attr['id']     = "menu-{$context}";

		$menu_name = hybrid_get_menu_location_name( $context );

		if ( $menu_name ) {
			// Translators: The %s is the menu name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Menu', 'nav menu aria label', 'hybrid-core' ), $menu_name ) );
		}

		if ( $this->args['menu_all'] ) {
			$attr['class']      .= " {$this->args['menu_all']}";
		}

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

		$attr['id']    = 'branding';
		$attr['class'] = 'site-branding';

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

		$attr['id']       = 'site-title';
		$attr['class']    = 'site-title';
		$attr['itemprop'] = 'name';

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

		$attr['id']       = 'site-description';
		$attr['class']    = 'site-description';

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

		$attr['class']     = 'archive-header';

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

		$attr['class']     = 'archive-title';

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

		$attr['class']     = 'archive-description';

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

		if ( is_singular() && ! abe_has_layout( 'blank-canvas' ) ) {
			is_single( $post_id ) || is_page() ? $classes[] = "{$this->args['post']}" : $classes[] = "{$this->args['post_archive']}";
		}

		if ( is_archive() || is_search() || is_home() ) {
			$classes[]      = "{$this->args['post_archive']}"; }

		if ( abe_is_wide_layout() ) {
			$classes[]      = "{$this->args['post_wide']}"; }

		if ( is_search() ) {
			$classes[]      = 'u-1of1 u-flex u-flex-wrap u-mb1'; }

		return $classes;
	}

	/**
	 * Class selectors added to the element.
	 *
	 * @param  array $attr Adds classes to hybrid_attr.
	 * @return array
	 */
	public function entry_title( $attr ) {

		$attr['class']    = 'entry-title';
		$attr['itemprop'] = 'headline';

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

		$attr['class'] = 'entry-content';

		if ( ! $this->args['entry_content'] ) {
			return $attr;
		}

		if ( abe_is_wide_layout() ) :
			$attr['class']      .= " {$this->args['entry_content_wide']}";
		endif;

		if ( ! abe_has_layout( 'blank-canvas' ) ) :
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

		$attr['class']    = 'entry-summary';

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
		$current_page_item = $this->args['current_page_item'] ? 'current_page_item' : null;
		$current_page_parent = $this->args['current_page_parent'] ? 'current_page_parent' : null;
		$current_page_ancestor = $this->args['current_page_ancestor'] ? 'current_page_ancestor' : null;
		$current_menu_item = $this->args['current-menu-item'] ? 'current-menu-item' : null;
		$menu_item_has_children = $this->args['menu-item-has-children'] ? 'menu-item-has-children' : null;
		$sub_menu = $this->args['sub-menu'] ? 'sub-menu' : null;

		$replace = array(
			$current_page_item      => "current_page_item {$this->args['current_page_item']}",
			$current_page_parent    => "current_page_parent {$this->args['current_page_parent']}",
			$current_page_ancestor  => "current_page_ancestor {$this->args['current_page_ancestor']}",
			$current_menu_item      => "current-menu-item {$this->args['current-menu-item']}",
			$menu_item_has_children => "menu-item-has-children {$this->args['menu-item-has-children']}",
			$sub_menu               => "sub-menu {$this->args['sub-menu']}",
		);
		$text = str_replace( array_keys( $replace ), $replace, $text );
		return $text;
	}

}

new Attr_Trumps();
