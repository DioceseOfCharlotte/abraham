<?php get_header(); // Loads the header.php template. ?>

<main id="content" class="content layout__item">

	<?php hybrid_get_menu( 'forum-views' ); // Loads the menu/forum-views.php template. ?>

	<?php $forums = mb_get_forums(); ?>

	<?php if ( !empty( $forums ) ) : ?>

		<table>
			<thead>
				<tr>
					<th>Forums <?php mb_topic_form_link(); ?></th>
					<th class="num">Topics</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Forums</th>
					<th class="num">Topics</th>
				</tr>
			</tfoot>
			<tbody>

			<?php foreach ( $forums as $forum ) : ?>

				<tr>
					<td>
						<?php mb_forum_link( $forum->term_id ); ?>
						<div class="entry-meta">
							<?php mb_list_forums( array( 'parent' => $forum->term_id ) ); ?>
						</div>
					</td>
					<td class="num"><?php mb_forum_topic_count( $forum->term_id ); ?></td>
				</tr>

			<?php endforeach; ?>

			</tbody>
		</table>

	<?php endif; ?>

	<?php mb_topic_form(); ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>
