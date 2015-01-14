<?php
/**
 * @package Scratch
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

	<?php echo ( $video = hybrid_media_grabber( array( 'width' => 1100, 'type' => 'video', 'split_media' => true, 'before' => '<div class="FlexEmbed"><div class="FlexEmbed-ratio FlexEmbed-ratio--16by9"></div>', 'after' => '</div>' ) ) ); ?>

	<header class="entry-header">
		<?php get_template_part( 'partials/entry', 'title' ); ?>
	</header><!-- .entry-header -->

<?php if ( is_single( get_the_ID() ) ) : ?>

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div><!-- .entry-content -->

<?php else : // If not viewing a single post. ?>

		<?php if ( has_excerpt() ) : // If the post has an excerpt. ?>

			<div <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php elseif ( empty( $video ) ) : // Else, if the post does not have a video. ?>

			<div <?php hybrid_attr( 'entry-content' ); ?>>
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		<?php endif; // End excerpt/video checks. ?>

<?php endif; // End single post check. ?>

	<footer class="entry-footer">
	  <?php scratch_entry_meta(); ?>
	  <?php scratch_post_terms(); ?>
	</footer><!-- .entry-footer -->

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
