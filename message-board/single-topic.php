<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

		<div class="loop-meta">
			<h1 class="topic-title loop-title"><?php mb_single_topic_title(); ?></h1>

			<div class="loop-description layout">
					<?php mb_topic_forum_link( get_queried_object_id() ); ?>
					<span class="entry-terms topic-posts">
						<?php $count = mb_get_topic_post_count( get_queried_object_id() ); ?>
						<?php echo ( 1 == $count ) ? "{$count} <i class='fa fa-comment'></i>" : "{$count} <i class='fa fa-comments'></i>"; ?>
					</span>
					<span class="entry-terms topic-voices">
						<?php $voices = mb_get_topic_voice_count( get_queried_object_id() ); ?>
						<?php echo ( 1 == $voices ) ? "{$voices} <i class='fa fa-user'></i>" : "{$voices} <i class='fa fa-users'></i>"; ?>
					</span>
					<span class="entry-terms topic-subscribe fa fa-envelope-o">
						<?php mb_topic_subscribe_link(get_queried_object_id()); ?>
					</span>
					<span class="entry-terms topic-favorite fa fa-bookmark-o">
						<?php mb_topic_favorite_link(get_queried_object_id()); ?>
					</span>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<ol id="thread" class="comment-list">

	<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

		<?php the_post(); // Loads the post data. ?>

		<?php get_template_part( 'message-board/content-topic' ); ?>

		<?php if ( mb_has_replies() ) : ?>

			<?php while ( mb_replies() ) : ?>

				<?php mb_the_reply(); ?>

				<?php get_template_part( 'message-board/content-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</ol><!-- #thread -->

		<div class="loop-nav">
			<?php echo mb_topic_pagination(); ?>
		</div><!-- .comments-nav -->

		<?php mb_reply_form(); // Loads the topic reply form. ?>

	<?php endwhile; // End found posts loop. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
