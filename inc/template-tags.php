<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Abraham
 */

if ( ! function_exists( 'abraham_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function abraham_paging_nav() {

<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav">
		<?php previous_post_link( '<div class="prev">' . __( 'Previous Post: %link', 'abraham' ) . '</div>', '%title' ); ?>
		<?php next_post_link(     '<div class="next">' . __( 'Next Post: %link',     'abraham' ) . '</div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php loop_pagination(
		array(
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'abraham' ),
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'abraham' )
		)
	); ?>

<?php endif; // End check for type of page being viewed. ?>
	<?php
}
endif;

if ( ! function_exists( 'abraham_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function abraham_posted_on() { ?>
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' );
				 edit_post_link();
}
endif;

if ( ! function_exists( 'abraham_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function abraham_entry_footer() {
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'abraham' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'abraham' ), 'before' => '<br />' ) );
}
endif; ?>











<?php
if ( ! function_exists( 'abraham_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function abraham_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'abraham' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'abraham' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'abraham' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function abraham_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'abraham_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'abraham_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so abraham_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so abraham_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in abraham_categorized_blog.
 */
function abraham_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'abraham_categories' );
}
add_action( 'edit_category', 'abraham_category_transient_flusher' );
add_action( 'save_post',     'abraham_category_transient_flusher' );
