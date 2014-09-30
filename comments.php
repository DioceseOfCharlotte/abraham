<?php
/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments-template" class="comments-template">

	<?php if ( have_comments() ) : ?>

		<div id="comments" class="comments-area">

			<h3 id="comments-number" class="comments-number"><?php comments_number(); ?></h3>

			<ol class="comment-list">
				<?php wp_list_comments(
					array(
						'style'        => 'ol',
						'callback'     => 'hybrid_comments_callback',
						'end-callback' => 'hybrid_comments_end_callback'
					)
				); ?>
			</ol><!-- .comment-list -->

			<?php abraham_comments_nav(); ?>

		</div><!-- #comments-->

	<?php endif; // End check for comments. ?>

	<?php abraham_comments_error(); ?>

	<?php comment_form(); ?>

</section><!-- #comments-template -->
