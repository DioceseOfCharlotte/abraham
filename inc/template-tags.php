<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Abraham
 */


if ( ! function_exists( 'doc_icon' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function abe_icon($icon, $size) {
	echo '<img data-src="' . get_stylesheet_directory_uri() . '/images/svg/smart/' . $icon . '.svg"class="iconic iconic-' . $size . '">';
}
endif;

if ( ! function_exists( 'abraham_loop_meta' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function abraham_loop_meta() { ?>

        <div <?php hybrid_attr( 'loop-meta' ); ?>>
        	<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>
        	<?php if ( !is_paged() && $desc = hybrid_get_loop_description() ) : // Check if we're on page/1. ?>
        		<div <?php hybrid_attr( 'loop-description' ); ?>>
        			<?php echo $desc; ?>
        		</div><!-- .loop-description -->
        	<?php endif; // End paged check. ?>
        </div><!-- .loop-meta -->
	<?php
}
endif;

if ( ! function_exists( 'abraham_loop_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function abraham_loop_nav() {

if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav">
		<?php previous_post_link( '<div class="prev">' . __( '%link', 'abraham' ) . '</div>', '&larr; %title' ); ?>
		<?php next_post_link(     '<div class="next">' . __( '%link',     'abraham' ) . '</div>', '%title &rarr;' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results.

	loop_pagination(
		array(
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'abraham' ),
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'abraham' )
		)
	);

endif; // End check for type of page being viewed. ?>
	<?php
}
endif;

if ( ! function_exists( 'abraham_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function abraham_posted_on() { ?>
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php abe_icon('inkwell', 'sm') ?><?php the_author_posts_link(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php abe_icon('calendar', 'sm') ?><?php echo get_the_date(); ?></time>
				<?php abe_icon('chat', 'sm') ?><?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' );
				 edit_post_link();
}
endif;

if ( ! function_exists( 'abraham_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function abraham_entry_footer() {
			hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'abraham' ) ) );
			hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'abraham' ), 'before' => '<br />' ) );
}
endif;

if ( ! function_exists( 'abraham_comments_nav' ) ) :
/**
 * Display navigation to next/previous set of comments.
 */
function abraham_comments_nav() {
if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : // Check for paged comments. ?>

	<nav class="comments-nav" role="navigation" aria-labelledby="comments-nav-title">

		<h3 id="comments-nav-title" class="screen-reader-text"><?php _e( 'Comments Navigation', 'abraham' ); ?></h3>

		<?php previous_comments_link( _x( '&larr; Previous', 'comments navigation', 'abraham' ) ); ?>

		<span class="page-numbers"><?php
			/* Translators: Comments page numbers. 1 is current page and 2 is total pages. */
			printf( __( 'Page %1$s of %2$s', 'abraham' ), get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() );
		?></span>

		<?php next_comments_link( _x( 'Next &rarr;', 'comments navigation', 'abraham' ) ); ?>

	</nav><!-- .comments-nav -->

<?php endif; // End check for paged comments.
}
endif;

if ( ! function_exists( 'abraham_comments_error' ) ) :
/**
 * Display navigation to next/previous set of comments.
 */
function abraham_comments_error() {
if ( pings_open() && !comments_open() ) : ?>

	<p class="comments-closed pings-open">
		<?php
			/* Translators: The two %s are placeholders for HTML. The order can't be changed. */
			printf( __( 'Comments are closed, but %strackbacks%s and pingbacks are open.', 'abraham' ), '<a href="' . esc_url( get_trackback_url() ) . '">', '</a>' );
		?>
	</p><!-- .comments-closed .pings-open -->

<?php elseif ( !comments_open() ) : ?>

	<p class="comments-closed">
		<?php _e( 'Comments are closed.', 'abraham' ); ?>
	</p><!-- .comments-closed -->

<?php endif;
}
endif; ?>






<?php

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