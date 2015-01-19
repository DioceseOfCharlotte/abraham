<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Abraham
 */

if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
 
tha_comments_before(); ?>

<section id="comments" class="comments">

	<?php if ( have_comments() ) : ?>

		<h3 id="comments-number"><?php comments_number(); ?></h3>

		<ol class="comment-list">
			<?php wp_list_comments(
				array(
					'style'        => 'ol',
					'type'         => 'all',
					'avatar_size'  => 80,
					'callback'     => 'hybrid_comments_callback',
					'end-callback' => 'hybrid_comments_end_callback'
				)
			); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="comments-nav" role="navigation" aria-labelledby="comments-nav-title">
				<h3 id="comments-nav-title" class="screen-reader-text">
					<?php _e( 'Comments Navigation', 'abraham' ); ?>
				</h3>
				<span class="comments__page-count">
					<?php printf( __( 'Comments page %1$s of %2$s', 'abraham' ), get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() ); ?>
				</span>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'abraham' ) ); ?></div>

				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'abraham' ) ); ?></div>
			</nav><!-- .comments-nav -->
	
		<?php endif; // End check for paged comments. ?>

	<?php endif; // End check for comments. ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="comments-closed">
			<?php _e( 'Comments are closed.', 'abraham' ); ?>
		</p>

	<?php endif; ?>

	<?php comment_form(); ?>

</section><!-- #comments -->

<?php
tha_comments_after();
