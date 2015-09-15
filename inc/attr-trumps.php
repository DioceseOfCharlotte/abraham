<?php

//namespace Abraham\Attr_Trumps;

function attr_trumps($args = array()) {
    $trump = apply_filters('attr_trumps_object', null, $args);
    if (!is_object($trump))
        $trump = new Attr_Trumps($args);
}

/**
 * Add class selectors to hybrid attributes.
 *
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
     *
     */
    public function __construct($args = array()) {

        $defaults = array(
            'body'                    => '',
            'site_container'          => '',
            'container'               => '',
            'container_header'        => '',
            'container_wide'          => '',
            'row'                     => '',
            'row_layout'              => '',
            'row_layout_sidebar_l'    => '',
            'row_layout_sidebar_r'    => '',

            // SITE HEADER
            'header'                  => '',
            'branding'                => '',
            'site_title'              => '',
            'site_description'        => '',

            // CONTENT
            'content'                 => '',
            'content_with_sidebar'    => '',
            'content_archive'         => '',
            // ENTRY
            'post'                    => '',
			'post_archive'            => '',

            'page_header'             => '',

            'entry_title'             => '',
            'page_title'    		  => '',
            'archive_description'     => '',

            'entry_header'            => '',
            'entry_content'           => '',
            'entry_content_wide'      => '',
            'entry_summary'           => '',
            'entry_footer'            => '',

            'nav_single'              => '',
            'nav_archive'             => '',

            // ENTRY META
            'entry_author'            => '',
            'entry_published'         => '',
            'entry_terms'             => '',

            // NAVIGATION
            'menu_all'                => '',
            'menu_primary'            => '',
            'menu_secondary'          => '',

            // SIDEBAR
            'sidebar_primary'         => '',
			'sidebar_footer'          => '',
            'sidebar_horizontal'      => '',
            'sidebar_right'           => '',
            'sidebar_left'            => '',

			'widgets'                 => '',
			'primary_widgets'         => '',
			'footer_widgets'          => '',

            // COMMENTS
            'comments_area'           => '',

            // FOOTER
            'footer'                  => '',

            'menu_item'                 => '',
            'menu_link'                 => '',
            'current_page_item'         => '',
            'current_page_parent'       => '',
            'current_page_ancestor'     => '',
            'current-menu-item'         => '',
            'menu-item-has-children'    => '',
            'sub-menu'                  => '',

            'gv_container'              => '',
            'gv_entry'                  => '',
        );

        $this->args = apply_filters('attr_trumps_args', wp_parse_args($args, $defaults));

        // CONTAINERS
        add_filter('hybrid_attr_body',                  array($this, 'body'));
        add_filter('hybrid_attr_container',             array($this, 'container'), 10, 2);
        add_filter('hybrid_attr_row',                   array($this, 'row'), 10, 2);

        // SITE HEADER
        add_filter('hybrid_attr_header',                array($this, 'header'));
        add_filter('hybrid_attr_branding',              array($this, 'branding'));
        add_filter('hybrid_attr_site-title',            array($this, 'site_title'));
        add_filter('hybrid_attr_site-description',      array($this, 'site_description'));

        // CONTENT
        add_filter('hybrid_attr_content',               array($this, 'content'));

        // ENTRY
        add_filter('hybrid_attr_post',                  array($this, 'post'));
        add_filter('hybrid_attr_archive-header',        array($this, 'page_header'));
        add_filter('hybrid_attr_archive-title',         array($this, 'page_title'));
        add_filter('hybrid_attr_archive-description',   array($this, 'archive_description'));
        add_filter('hybrid_attr_entry-header',          array($this, 'entry_header'));
        add_filter('hybrid_attr_entry-title',           array($this, 'entry_title'));
        add_filter('hybrid_attr_entry-content',         array($this, 'entry_content'));
        add_filter('hybrid_attr_entry-summary',         array($this, 'entry_summary'));
        add_filter('hybrid_attr_entry-footer',          array($this, 'entry_footer'));

        // ENTRY META
        add_filter('hybrid_attr_entry-author',          array($this, 'entry_author'));
        add_filter('hybrid_attr_entry-published',       array($this, 'entry_published'));
        add_filter('hybrid_attr_entry-terms',           array($this, 'entry_terms'));

        // NAVIGATION
        add_filter('hybrid_attr_menu',                  array($this, 'menu'), 10, 2);

        // SIDEBAR
        add_filter('hybrid_attr_sidebar',               array($this, 'sidebar'), 10, 2);

		add_filter('hybrid_attr_widgets',  				array($this, 'widgets'), 10, 2);

        // FOOTER
        add_filter('hybrid_attr_footer',                array($this, 'footer'));

        // COMMENTS
        add_filter('hybrid_attr_comments-area',         array($this, 'comments_area'));

        add_filter('nav_menu_link_attributes',          array($this, 'menu_link'), 10, 3);

        add_filter ('wp_nav_menu',                      array($this, 'nav_menu_filters'));
        add_filter('nav_menu_css_class' ,               array($this, 'menu_item') , 10 , 2);

        add_filter('gravityview/render/container/class',  	     array($this, 'gv_container'), 10, 1);
        add_filter('gravityview_entry_class',  			         array($this, 'gv_entry'), 10, 3);
    }




    /* === OBJECTS === */

    public function body($attr) {
        $attr['class']      .= " {$this->args['body']}";
        return $attr;
    }

    public function container($attr, $context) {
        if (empty($context)) {
            return $attr;
        }
        $attr['class']      = $this->args['container'];
        $attr['class']      .= " container--{$context}";

        if ('1-column-wide' ==  hybrid_get_theme_layout('theme_layout') && 'content' === $context) {
        $attr['class']      .= " {$this->args['container_wide']}";
        }
        if ('header' === $context) {
        $attr['class']      .= " {$this->args['container_header']}";
        }
		if ('content' === $context) {
        $attr['class']      .= " {$this->args['site_container']}";
        }
        return $attr;
    }

    public function row($attr, $context) {
        if (empty($context)) {
            return $attr;
        }
        $attr['class']      = $this->args['row'];
        $attr['class']      .= " row row--{$context}";

        if ('layout' === $context) {

        if ('sidebar-right'     ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['row_layout_sidebar_r']}";

        elseif ('sidebar-left'     ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['row_layout_sidebar_l']}";

        else : $attr['class']      .= " {$this->args['row_layout']}";

        endif;
        }

        return $attr;
    }

    public function nav($attr, $context) {

        if ('single' === $context) {
        $attr['class']      .= " {$this->args['nav_single']}";
        }
        if ('archive' === $context) {
        $attr['class']      .= " {$this->args['nav_archive']}";
        }
        return $attr;
    }

    public function comments_area($attr) {
        if ($this->args['comments_area']) {
        $attr['class']      = $this->args['comments_area'];
    }
        return $attr;
    }

    public function header($attr) {
        if ($this->args['header']) {
        $attr['class']      = $this->args['header'];
    }
        return $attr;
    }

    public function footer($attr) {
        if ($this->args['footer']) {
        $attr['class']      = $this->args['footer'];
    }
    return $attr;
    }

    public function content($attr) {

        if ('1-column-wide'   ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      = $this->args['content'];

        elseif ('1-column'    ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      = $this->args['content'];

        elseif ('sidebar-right'     ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      = $this->args['content_with_sidebar'];

        elseif ('sidebar-left'     ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      = $this->args['content_with_sidebar'];
        endif;

        if (hybrid_is_plural()) {
            $attr['class']      .= " {$this->args['content_archive']}";
        }

        return $attr;
    }

    public function sidebar($attr, $context) {
        if (empty($context)) {
            return $attr;
        }
        if ('primary' === $context) {

        if ('1-column-wide'   ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['sidebar_horizontal']}";
        elseif ('1-column'    ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['sidebar_horizontal']}";

        elseif ('sidebar-right' ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['sidebar_right']}";
        elseif ('sidebar-left' ==  hybrid_get_theme_layout('theme_layout')) :
        $attr['class']      .= " {$this->args['sidebar_left']}";
        endif;


        $attr['class']      .= " {$this->args['sidebar_primary']}";
        }
		if ('footer' === $context) {
		$attr['class']      .= " {$this->args['sidebar_footer']}";
        }
        return $attr;
    }

	public function widgets($attr, $context) {
		if (empty($context)) {
            return $attr;
        }
        if ($this->args['widgets']) {
        $attr['class']      = $this->args['widgets'];

		if ('footer' === $context) {
		$attr['class']      .= " {$this->args['footer_widgets']}";
		}
		if ('primary' === $context) {
		$attr['class']      .= " {$this->args['primary_widgets']}";
		}
        return $attr;
    }
    }

    public function menu($attr, $context) {
        if (empty($context)) {
        return $attr;
        }
        $attr['class']      .= " {$this->args['menu_all']}";

        if ('primary' === $context) {
        $attr['class']      .= " {$this->args['menu_primary']}";
        }
        if ('secondary' === $context) {
        $attr['class']      .= " {$this->args['menu_secondary']}";
        }
        return $attr;
    }

    /* === COMPONENTS === */

    public function branding($attr) {
        if (!$this->args['branding']) {
        return $attr;
        }
        $attr['class']      = $this->args['branding'];
    return $attr;
    }


    public function site_title($attr) {
        if ($this->args['site_title']) {
        $attr['class']      = " {$this->args['site_title']}";
        return $attr;
    }
    }

    public function site_description($attr) {
        if ($this->args['site_description']) {
        $attr['class']      = $this->args['site_description'];
        return $attr;
    }
    }

    /* === LOOP === */

    public function page_header($attr) {
        $attr['class']      = 'page-header';
        if ($this->args['page_header']) {
        $attr['class']      .= " {$this->args['page_header']}";
    }
        return $attr;
    }

    public function page_title($attr) {
    if ($this->args['page_title']) {
        $attr['class']      = $this->args['page_title'];
    }
        return $attr;
    }

    public function archive_description($attr) {
    if ($this->args['archive_description']) {
        $attr['class']      = $this->args['archive_description'];
    }
        return $attr;
    }

    /* === POSTS === */

    public function post($attr) {
        $attr['class']      .= " {$this->args['post']}";
	if (hybrid_is_plural()) {
		$attr['class']      .= " {$this->args['post_archive']}";
	}
        return $attr;
    }

    public function entry_title($attr) {
    if ($this->args['entry_title']) {
        $attr['class']      = $this->args['entry_title'];
    }
        return $attr;
    }

    public function entry_author($attr) {
    if ($this->args['entry_author']) {
        $attr['class']      = $this->args['entry_author'];
    }
        return $attr;
    }


    public function entry_published($attr) {

        $attr['class']      .= " {$this->args['entry_published']}";
        return $attr;
    }

    public function entry_header($attr) {
        $attr['class']      = "entry-header";

        $attr['class']      .= " {$this->args['entry_header']}";
        return $attr;
    }

    public function entry_content($attr) {
    if ('1-column-wide'   ==  hybrid_get_theme_layout('theme_layout')) {
        $attr['class']      .= " {$this->args['entry_content_wide']}";
    } else {
        $attr['class']      .= " {$this->args['entry_content']}";
    }
        return $attr;
    }

    public function entry_summary($attr) {

        $attr['class']      .= " {$this->args['entry_summary']}";
        return $attr;
    }

    public function entry_footer($attr) {
        $attr['class']      = "entry-footer";

        $attr['class']      .= " {$this->args['entry_footer']}";
        return $attr;
    }

    public function entry_terms($attr) {

        $attr['class']      .= " {$this->args['entry_terms']}";
        return $attr;
    }



    public function menu_item($attr, $item){

        $attr[] .= $this->args['menu_item'];
        return $attr;
    }

    public function menu_link($attr, $item, $args) {
        $attr['class'] = $this->args['menu_link'];
        return $attr;
    }

    public function nav_menu_filters($text){
      $replace = array(
        //List of menu item classes that should be changed to "active"
        'current_page_item' => $this->args['current_page_item'],
        'current_page_parent' => $this->args['current_page_parent'],
        'current_page_ancestor' => $this->args['current_page_ancestor'],
        'current-menu-item' => $this->args['current-menu-item'],
        'menu-item-has-children' => $this->args['menu-item-has-children'],
        'sub-menu' => $this->args['sub-menu'],
      );
      $text = str_replace(array_keys($replace), $replace, $text);
        return $text;
      }

      public function gv_container($attr) {

          $attr     .= " {$this->args['gv_container']}";
          return $attr;
      }

      public function gv_entry($attr, $entry, $instance) {

          $attr     .= " {$this->args['gv_entry']}";
          return $attr;
      }

}

new Attr_Trumps();
