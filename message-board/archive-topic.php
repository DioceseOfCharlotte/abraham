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

			<div class="layout layout__topics">

			<?php while ( mb_have_topics() ) : // Begins the loop through found posts. ?>

				<?php mb_the_topic(); // Loads the post data. ?>


					<a class="card--link layout board-topic all-1 md-1-2 lg-1-3 xl-1-4 topic-link layout__item <?php echo mb_is_topic_sticky() ? 'sticky' : ''; ?>" href="<?php mb_topic_url(); ?>">
						<h6><?php mb_topic_title(); ?></h6>
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
		<?php endwhile; // End found posts loop. ?>

			</div>

		<?php abraham_loop_nav(); ?>

	<?php endif; // End check for posts. ?>

	<?php mb_topic_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>