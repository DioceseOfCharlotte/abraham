<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kit
 */

if ( ! function_exists( 'kit_loop_meta' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function kit_loop_meta() { ?>

<div <?php hybrid_attr( 'loop-meta' ); ?>>

	<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>

	<?php if ( is_category() || is_tax() ) : ?>

		<?php hybrid_get_menu( 'sub-terms' ); ?>

	<?php endif; // End taxonomy check. ?>

	<?php if ( !is_paged() && $desc = hybrid_get_loop_description() ) : // Check if we're on page/1. ?>

		<div <?php hybrid_attr( 'loop-description' ); ?>>
			<?php echo $desc; ?>
		</div><!-- .loop-description -->

	<?php endif; // End paged check. ?>

</div><!-- .loop-meta -->
	<?php
}
endif;

if ( ! function_exists( 'kit_loop_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function kit_loop_nav() {

if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav">
		<?php previous_post_link( '<div class="prev">' . __( 'Previous Post: %link', 'kit' ) . '</div>', '%title' ); ?>
		<?php next_post_link(     '<div class="next">' . __( 'Next Post: %link',     'kit' ) . '</div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. 

	loop_pagination(
		array( 
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'kit' ), 
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'kit' )
		) 
	);

	endif; // End check for type of page being viewed. 
}
endif;

if ( ! function_exists( 'kit_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function kit_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'kit' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'kit' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'kit' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'kit_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function kit_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'kit' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'kit' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'kit' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'kit_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function kit_posted_on() { ?>
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
<?php }
endif;

if ( ! function_exists( 'kit_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function kit_entry_footer() { ?>
<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'kit' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'kit' ), 'before' => '<br />' ) ); ?>
<?php }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kit_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'kit_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kit_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kit_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kit_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kit_categorized_blog.
 */
function kit_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'kit_categories' );
}
add_action( 'edit_category', 'kit_category_transient_flusher' );
add_action( 'save_post',     'kit_category_transient_flusher' );
