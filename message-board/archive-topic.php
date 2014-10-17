<?php
/**
 * The main forum topic template file.
 *
 * @package Abraham
 */

get_header(); ?>

<main id="content" class="content layout__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<?php if ( mb_have_topics() ) : // Checks if any posts were found. ?>

					<div>
						<?php if ( current_user_can( 'create_forum_topics' ) ) : ?>
						<a href="<?php mb_topic_form_url(); ?>" class="new-topic">New Topic <i class="fa fa-plus-circle"></i></a>
						<?php endif; ?>
					</div>

			<div class="layout">

			<?php while ( mb_have_topics() ) : // Begins the loop through found posts. ?>

				<?php mb_the_topic(); // Loads the post data. ?>

				<div class="board-topic layout__item <?php echo mb_is_topic_sticky() ? 'sticky' : ''; ?>">
					<a class="topic-link layout__item" href="<?php mb_topic_url(); ?>">
						<h4><?php mb_topic_title(); ?></h4>
						<div class="entry-meta">

							<?php mb_topic_labels(); ?>

<div class="text-minor">
Last post by
<strong><?php mb_topic_last_poster(); ?> -
<?php mb_topic_last_active_time(); ?> ago</strong>
</div>
						</div><!-- .entry-meta -->
					<div class="post-num">
						<span class="num"><?php mb_topic_post_count( get_the_ID() ); ?></span>
					</div>
					</a>
				</div>
		<?php endwhile; // End found posts loop. ?>

			</div>

		<?php abraham_loop_nav(); ?>

	<?php endif; // End check for posts. ?>

	<?php mb_topic_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
