<?php
/**
 * Add classes to hybrid attributs.
 *
 * @package Abraham
 */

class Doc_Attributes {

	/* Attributes for major structural elements. */
	public $body                  	= ' ';	// get_body_class()
	public $header                	= ' t-primary-base'; 	// site-header
	public $footer                	= ' t-secondary-base'; 	// site-footer
	public $content_single_column 	= ''; 	// content
	public $content_sidebar_right 	= ''; 	// content
	public $content_sidebar_left 	= ''; 	// content
	public $sidebar_single_column  	= '';	// sidebar sidebar__{$context}
	public $sidebar_sidebar_right 	= ' ';	// sidebar sidebar__{$context}
	public $sidebar_sidebar_left 	  = ' ';	// sidebar sidebar__{$context}
	public $sidebar_footer          = '';	// sidebar sidebar__{$context}
	public $menu                  	= ' t-primary-dark';	// menu menu-{$context}
	public $menu_li_primary         = 'menu-primary__item';	// menu-item
	public $menu_li_secondary       = 'menu-secondary__item';	// menu-item
	public $menu_li_social          = 'menu-social__item';	// menu-item

	/* Header attributes. */
	public $branding              	= ' t-white';	// site-branding
	public $site_title            	= ' ';	// site-title
	public $site_description      	= ' ';	// site-description

	/* Loop attributes. */
	public $loop_meta             	= ' ';	// loop-meta
	public $loop_title            	= ' ';	// loop-title
	public $loop_description      	= ' ';	// loop-description

	/* Post-specific attributes. */
	public $post                  	= ' ';	// get_post_class()
	public $entry_title           	= ' ';	// entry-title
	public $entry_author          	= ' entry-meta__author';	// entry-author
	public $entry_published       	= ' entry-meta__date';	// entry-published updated
	public $entry_content         	= ' ';	// entry-content
	public $entry_summary         	= ' ';	// entry-summary
	public $entry_terms           	= ' ';	// entry-terms






	public function __construct() {

		/* Objects. */
		add_filter( 'hybrid_attr_body',              array( $this, 'body' ) );
		add_filter( 'hybrid_attr_header',            array( $this, 'header' ) );
		add_filter( 'hybrid_attr_footer',            array( $this, 'footer' ) );
		add_filter( 'hybrid_attr_content',           array( $this, 'content' ) );
		add_filter( 'hybrid_attr_sidebar',           array( $this, 'sidebar' ), 10, 2 );
		add_filter( 'hybrid_attr_menu',              array( $this, 'menu' ), 10, 2 );
		add_filter( 'hybrid_attr_loop-meta',         array( $this, 'loop_meta' ) );

		/* Components. */
		add_filter( 'nav_menu_css_class',            array( $this, 'menu_li' ), 10, 2 );
		add_filter( 'hybrid_attr_branding',          array( $this, 'branding' ) );
		add_filter( 'hybrid_attr_site-title',        array( $this, 'site_title' ) );
		add_filter( 'hybrid_attr_site-description',  array( $this, 'site_description' ) );
		add_filter( 'hybrid_attr_loop-title',        array( $this, 'loop_title' ) );
		add_filter( 'hybrid_attr_loop-description',  array( $this, 'loop_description' ) );

		/* Post-specific. */
		add_filter( 'hybrid_attr_post',              array( $this, 'post' ) );
		add_filter( 'hybrid_attr_entry-title',       array( $this, 'entry_title' ) );
		add_filter( 'hybrid_attr_entry-author',      array( $this, 'entry_author' ) );
		add_filter( 'hybrid_attr_entry-published',   array( $this, 'entry_published' ) );
		add_filter( 'hybrid_attr_entry-content',     array( $this, 'entry_content' ) );
		add_filter( 'hybrid_attr_entry-summary',     array( $this, 'entry_summary' ) );
		add_filter( 'hybrid_attr_entry-terms',       array( $this, 'entry_terms' ) );

	}




	/* === OBJECTS === */
	public function body( $attr ) {
		$attr['class']    .= $this->body;
		return $attr;
	}

	public function header( $attr ) {
		$attr['class']    .= $this->header;
		return $attr;
	}

	public function footer( $attr ) {
		$attr['class']    .= $this->footer;
		return $attr;
	}

	public function content( $attr ) {
	if ( '1-c' 	== get_theme_mod( 'theme_layout' ) ) :
		$attr['class']    	.= $this->content_single_column;
	elseif ( '2c-l' 	== get_theme_mod( 'theme_layout' ) ) :
		$attr['class']    	.= $this->content_sidebar_right;
	elseif ( '2c-r'	 	== get_theme_mod( 'theme_layout' ) ) :
		$attr['class']    	.= $this->content_sidebar_left;
	endif;
		return $attr;
	}

	public function sidebar( $attr, $context ) {
		if ( empty( $context ) ) {
			return $attr;
		}

		$attr['class']    		.= " sidebar-{$context}";

	if ( 'primary' === $context ) {
		if ( '1c'		== get_theme_mod( 'theme_layout' ) ) :
			$attr['class']	.= $this->sidebar_single_column;
		elseif ( '2c-l'	== get_theme_mod( 'theme_layout' ) ) :
			$attr['class']	.= $this->sidebar_sidebar_right;
		elseif ( '2c-r'	== get_theme_mod( 'theme_layout' ) ) :
			$attr['class']	.= $this->sidebar_sidebar_left;
		endif;
	}

	if ( 'footer' === $context ) {
		$attr['class']    .= $this->sidebar_footer;
	}
		return $attr;
	}

	public function menu( $attr, $context ) {
		if ( empty( $context ) ) {
			return $attr;
		}
		$attr['class']    .= " menu-{$context}";
		$attr['class']    .= $this->menu;
		return $attr;
	}


	/* === COMPONENTS === */

	public function menu_li( $classes, $item ) {
    if ( $menu_name = 'primary' ) :
        $classes[] = $this->menu_li_primary;
	  elseif ( $menu_name = 'secondary' ) :
        $classes[] = $this->menu_li_secondary;
	  elseif ( $menu_name = 'social' ) :
        $classes[] = $this->menu_li_social;
	  endif;

    return $classes;
	}

	public function branding( $attr ) {
		$attr['class']    .= $this->branding;
		return $attr;
	}

	public function site_title( $attr ) {
		$attr['class']    .= $this->site_title;
		return $attr;
	}

	public function site_description( $attr ) {
		$attr['class']    .= $this->site_description;
		return $attr;
	}

	/* === LOOP === */
	public function loop_meta( $attr ) {
		$attr['class']    .= $this->loop_meta;
		return $attr;
	}

	public function loop_title( $attr ) {
		$attr['class']    .= $this->loop_title;
		return $attr;
	}

	public function loop_description( $attr ) {
		$attr['class']    .= $this->loop_description;
		return $attr;
	}


	/* === POSTS === */
	public function post( $attr ) {
		$attr['class']    .= $this->post;
		return $attr;
	}

	public function entry_title( $attr ) {
		$attr['class']    .= $this->entry_title;
		return $attr;
	}

	public function entry_author( $attr ) {
		$attr['class']    .= $this->entry_author;
		return $attr;
	}

	public function entry_published( $attr ) {
		$attr['class']    .= $this->entry_published;
		return $attr;
	}

	public function entry_content( $attr ) {
		$attr['class']    .= $this->entry_content;
		return $attr;
	}

	public function entry_summary( $attr ) {
		$attr['class']    .= $this->entry_summary;
		return $attr;
	}

	public function entry_terms( $attr ) {
		$attr['class']    .= $this->entry_terms;
		return $attr;
	}

}

$ShinyAtts = new Doc_Attributes();
