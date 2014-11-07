<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content grid__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

		<div class="loop-meta">

			<div class="loop-description grid">
			<div class="topic-info">
					<?php mb_topic_forum_link( get_queried_object_id() ); ?>
					&nbsp; &nbsp;
					<span class="entry-terms topic-posts">
						<?php $count = mb_get_topic_post_count( get_queried_object_id() ); ?>
						<?php echo ( 1 == $count ) ? "{$count} <i class='fa fa-comment'></i>" : "{$count} <i class='fa fa-comments'></i>"; ?>
					</span>
					&nbsp;
					<span class="entry-terms topic-voices">
						<?php $voices = mb_get_topic_voice_count( get_queried_object_id() ); ?>
						<?php echo ( 1 == $voices ) ? "{$voices} <i class='fa fa-user'></i>" : "{$voices} <i class='fa fa-users'></i>"; ?>
					</span>
			</div>
			<div>
					<button class="entry-terms btn--small topic-subscribe fa fa-envelope-o">
						<?php mb_topic_subscribe_link(get_queried_object_id()); ?>
					</button>
					<button class="entry-terms btn--small topic-favorite fa fa-bookmark-o">
						<?php mb_topic_favorite_link(get_queried_object_id()); ?>
					</button>
			</div><!-- .loop-description -->
			</div>
			<h1 class="topic-title text-center loop-title"><?php mb_single_topic_title(); ?></h1>

		</div><!-- .loop-meta -->

	<div id="thread" class="comment-list">

	<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

		<?php the_post(); // Loads the post data. ?>

		<?php get_template_part( 'message-board/content-topic' ); ?>

		<?php if ( mb_has_replies() ) : ?>

			<?php while ( mb_replies() ) : ?>

				<?php mb_the_reply(); ?>

				<?php get_template_part( 'message-board/content-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</div><!-- #thread -->

		<div class="loop-nav">
			<?php echo mb_topic_pagination(); ?>
		</div><!-- .comments-nav -->

		<?php mb_reply_form(); // Loads the topic reply form. ?>

	<?php endwhile; // End found posts loop. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>