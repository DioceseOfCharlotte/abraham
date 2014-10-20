<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content layout__item">

		<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<?php if ( mb_have_topics() ) : // Checks if any posts were found. ?>

		<table>
			<thead>
				<tr>
					<th>Results <?php mb_topic_form_link(); ?></th>
					<th class="num">Posted</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Results</th>
					<th class="num">Posted</th>
				</tr>
			</tfoot>
			<tbody>

		<?php while ( mb_have_topics() ) : // Begins the loop through found posts. ?>

			<?php mb_the_topic(); // Loads the post data. ?>

				<tr>
					<td>
						<a class="topic-link" href="<?php get_permalink(); ?>"><?php the_title(); ?></a>
						<div class="entry-meta">

<?php the_excerpt(); ?>

						</div><!-- .entry-meta -->
					</td>
					<td class="num">
						<a style="font-size: 14px;" href="<?php echo get_permalink(); ?>"><?php echo human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ); ?> ago</a>
					</td>
				</tr>
		<?php endwhile; // End found posts loop. ?>

			</tbody>
		</table>

		<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

	<?php endif; // End check for posts. ?>

	<?php mb_topic_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
