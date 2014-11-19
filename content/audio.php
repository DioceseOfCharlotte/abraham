<article <?php hybrid_attr( 'post' ); ?>>

	<?php echo ( $audio = hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ) ); ?>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php doc_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>



		</header><!-- .entry-header -->

		<?php if ( has_excerpt() ) : // If the post has an excerpt. ?>

			<div <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php elseif ( empty( $audio ) ) : // Else, if the post does not have audio. ?>

			<div <?php hybrid_attr( 'entry-content' ); ?>>
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php doc_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php endif; // End excerpt/audio checks. ?>

	<?php endif; // End single post check. ?>

</article><!-- .entry -->