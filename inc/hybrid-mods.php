<?php
/**
 * Classes defined here will be used in templates throughout the theme.
 *
 */

class Doc_Attributes {

	/* Attributes for major structural elements. */
  public $body        				  = ' logo';
  public $header            	  = ' app-bar';
  public $footer     					  = ' doc-card layout__item';
  public $content        			  = ' logo';
  public $sidebar            	  = ' app-bar';
  public $menu     						  = ' doc-card';

	/* Header attributes. */
  public $branding        		  = ' logo';
  public $site_title            = ' app-bar';
  public $site_description      = ' doc-card  sm-1-2 lg-1-3';

	/* Loop attributes. */
  public $loop_meta        		  = ' logo';
  public $loop_title            = ' app-bar';
  public $loop_description      = ' doc-card  sm-1-2 lg-1-3';

	/* Post-specific attributes. */
  public $post        				  = ' logo';
  public $entry_title           = ' app-bar';
  public $entry_author     		  = ' doc-card layout__item lg-1-3';
  public $entry_published       = ' logo';
  public $entry_content         = ' app-bar';
  public $entry_summary     	  = ' doc-card palm-1-1 sm-1-2 lg-1-3';
  public $entry_terms      		  = ' doc-card palm-1-1 sm-1-2 lg-1-3';

	/* Comment specific attributes. */
  public $comment            	  = ' app-bar';
  public $comment_author        = ' logo';
  public $comment_published     = ' app-bar';
  public $comment_permalink     = ' doc-card layout__item lg-1-3';
  public $comment_content       = ' logo';



  public function __construct() {

/* Attributes for major structural elements. */
add_filter( 'hybrid_attr_body',    					array( $this, 'body' ) );
add_filter( 'hybrid_attr_header',  					array( $this, 'header' ) );
add_filter( 'hybrid_attr_footer',  					array( $this, 'footer' ) );
add_filter( 'hybrid_attr_content', 					array( $this, 'content' ) );
add_filter( 'hybrid_attr_sidebar',  				array( $this, 'sidebar' ) );
add_filter( 'hybrid_attr_menu', 						array( $this, 'menu' ) );

/* Header attributes. */
add_filter( 'hybrid_attr_branding',         array( $this, 'branding' ) );
add_filter( 'hybrid_attr_site-title',       array( $this, 'site_title' ) );
add_filter( 'hybrid_attr_site-description', array( $this, 'site_description' ) );

/* Loop attributes. */
add_filter( 'hybrid_attr_loop-meta',        array( $this, 'loop_meta' ) );
add_filter( 'hybrid_attr_loop-title',       array( $this, 'loop_title' ) );
add_filter( 'hybrid_attr_loop-description', array( $this, 'loop_description' ) );

/* Post-specific attributes. */
add_filter( 'hybrid_attr_post',            	array( $this, 'post' ) );
add_filter( 'hybrid_attr_entry-title',     	array( $this, 'entry_title' ) );
add_filter( 'hybrid_attr_entry-author',    	array( $this, 'entry_author' ) );
add_filter( 'hybrid_attr_entry-published', 	array( $this, 'entry_published' ) );
add_filter( 'hybrid_attr_entry-content',   	array( $this, 'entry_content' ) );
add_filter( 'hybrid_attr_entry-summary',   	array( $this, 'entry_summary' ) );
add_filter( 'hybrid_attr_entry-terms',     	array( $this, 'entry_terms' ) );

/* Comment specific attributes. */
add_filter( 'hybrid_attr_comment',           array( $this, 'comment' ) );
add_filter( 'hybrid_attr_comment-author',    array( $this, 'comment_author' ) );
add_filter( 'hybrid_attr_comment-published', array( $this, 'comment_published' ) );
add_filter( 'hybrid_attr_comment-permalink', array( $this, 'comment_permalink' ) );
add_filter( 'hybrid_attr_comment-content',   array( $this, 'comment_content' ) );
}


/* === STRUCTURAL === */

public function body( $attr ) {

	$attr['class']     .= $this->body;

	return $attr;
}

public function header( $attr ) {

	$attr['class']       = $this->header;

	return $attr;
}

public function footer( $attr ) {

	$attr['class']        = $this->footer;

	return $attr;
}

public function content( $attr ) {

	$attr['class']    = $this->content;

	return $attr;
}

public function sidebar( $attr ) {

	$attr['class']     .= $this->sidebar;

	return $attr;
}

public function menu( $attr ) {

	$attr['class']      .= $this->menu;

	return $attr;
}


/* === HEADER === */

public function branding( $attr ) {

	$attr['class']         = $this->branding;

	return $attr;
}

public function site_title( $attr ) {

	$attr['class']       = $this->site_title;

	return $attr;
}

public function site_description( $attr ) {

	$attr['class']       = $this->site_description;

	return $attr;
}


/* === LOOP === */

public function loop_meta( $attr ) {

	$attr['class']     = $this->loop_meta;

	return $attr;
}

public function loop_title( $attr ) {

	$attr['class']     = $this->loop_title;

	return $attr;
}

public function loop_description( $attr ) {

	$attr['class']     = $this->loop_description;

	return $attr;
}


/* === POSTS === */

public function post( $attr ) {

	$attr['class']     .= $this->post;

	return $attr;
}

public function entry_title( $attr ) {

	$attr['class']     .= $this->entry_title;

	return $attr;
}

public function entry_author( $attr ) {

	$attr['class']     .= $this->loop_description;

	return $attr;
}

public function entry_published( $attr ) {

	$attr['class']     .= $this->entry_published;

	return $attr;
}

public function entry_content( $attr ) {

	$attr['class']     .= $this->entry_content;

	return $attr;
}

public function entry_summary( $attr ) {

	$attr['class']     .= $this->entry_summary;

	return $attr;
}

public function entry_terms( $attr ) {

	$attr['class']     .= $this->entry_terms;

	return $attr;
}


/* === COMMENTS === */


function comment( $attr ) {

	$attr['class']  	.= $this->comment;

	return $attr;
}

function comment_author( $attr ) {

	$attr['class']     .= $this->comment-author;

	return $attr;
}

function comment_published( $attr ) {

	$attr['class']    .= $this->comment-published;

	return $attr;
}

function comment_permalink( $attr ) {

	$attr['class']    .= $this->comment-permalink;

	return $attr;
}

function comment_content( $attr ) {

	$attr['class']    .= $this->comment-content;

	return $attr;
}


}





//   public public function card( $attr ) {
//     if ( is_post_type_archive('employee') ) {
//       $attr['id']        = 'post-' . get_the_ID();
//       $attr['class']     = join( ' ', get_post_class($this->employee_card) );
//     }
//     else {
//       $attr['id']        = 'post-' . get_the_ID();
//       $attr['class']     = join( ' ', get_post_class() );
//     }
//     return $attr;
//   }

// }

$ShinyAtts = new Doc_Attributes();
