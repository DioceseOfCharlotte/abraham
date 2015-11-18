<?php
// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
    return;
?>

<section <?php hybrid_attr('comments-area'); ?>>
  <?php if (have_comments()) : ?>
    <h2 class="comments-title"><?php printf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'abraham'), number_format_i18n(get_comments_number()), '<span>'.get_the_title().'</span>'); ?></h2>

    <ol class="comment-list list-reset">
      <?php wp_list_comments(array('style' => 'ol', 'short_ping' => true)); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'abraham')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'abraham')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'abraham'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
