<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content grid__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<?php locate_template( array( 'misc/loop-meta.php' ), true ); // Loads the misc/loop-meta.php template. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<table>
			<thead>
				<tr>
					<th>Topics
						<?php if ( current_user_can( 'create_forum_topics' ) ) : ?>
						<a href="<?php mb_topic_form_url(); ?>" class="genericon-edit new-topic">New Topic &rarr;</a>
						<?php endif; ?>
					</th>
					<th class="num">Posts</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Topics</th>
					<th class="num">Posts</th>
				</tr>
			</tfoot>
			<tbody>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

				<tr class="<?php echo mb_is_topic_sticky() ? 'sticky' : ''; ?>">
					<td>
						<a class="topic-link" href="<?php mb_topic_url(); ?>"><?php mb_topic_title(); ?></a>
						<div class="entry-meta">

							<?php mb_topic_labels(); ?>

Last post
<a href="<?php mb_topic_last_post_url( get_the_ID() ); ?>">
<?php mb_topic_last_active_time( get_the_ID() ); ?> ago</a> by
<?php mb_topic_last_poster( get_the_ID() ); ?>

						</div><!-- .entry-meta -->
					</td>
					<td class="num">
						<a href="<?php mb_topic_last_post_url( get_the_ID() ); ?>"><?php mb_topic_post_count( get_the_ID() ); ?></a>
					</td>
				</tr>
		<?php endwhile; // End found posts loop. ?>

			</tbody>
		</table>

		<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

	<?php endif; // End check for posts. ?>

	<?php if ( function_exists( 'mb_topic_form' ) ) mb_topic_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>