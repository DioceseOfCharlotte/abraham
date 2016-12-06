<?php
/**
* Comments Template.
*
* @package Abraham
*/
if ( post_password_required() ) {
	return;
}
?>

<section <?php hybrid_attr( 'comments_area' ); ?>>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
	<h2 class="comments-title u-h3 u-text-display">
		<?php
		$comments_number = get_comments_number();
		if ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'abe' ), get_the_title() );
		} else {
			printf(
				/* translators: 1: number of comments, 2: post title */
				_nx(
					'%1$s Reply to &ldquo;%2$s&rdquo;',
					'%1$s Replies to &ldquo;%2$s&rdquo;',
					$comments_number,
					'comments title',
					'abe'
				),
				number_format_i18n( $comments_number ),
				get_the_title()
			);
		}
		?>
	</h2>

	<ol class="comment-list">
		<?php
		wp_list_comments( array(
			//'avatar_size' => 50,
			'style'       => 'ol',
			'short_ping'  => true,
			'reply_text'  => abe_get_svg( 'reply' ) . __( 'Reply', 'abe' ),
		) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => abe_get_svg( 'arrow-left' ) . '<span class="screen-reader-text">' . __( 'Previous', 'abe' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'abe' ) . '</span>' . abe_get_svg( 'arrow-right' ),
		) );

		endif; // Check for have_comments().

		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'abe' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
