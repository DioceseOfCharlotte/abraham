<?php
// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() || ( !have_comments() && !comments_open() ) )
	return;
?>

<section <?php hybrid_attr('comments-area'); ?>>
	<?php if (have_comments()) : ?>
		<h2 class="comments-title"><?php printf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'abraham'), number_format_i18n(get_comments_number()), '<span>'.get_the_title().'</span>'); ?></h2>

		<ol class="comment-list list-reset">
		  <?php wp_list_comments(array('style' => 'ol', 'short_ping' => true)); ?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; // have_comments() ?>

	<?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', '_s' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</section>
