<?php
/**
 * @package Abraham
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

	<?php echo ( $video = hybrid_media_grabber( array( 'width' => 1100, 'type' => 'video', 'split_media' => true, 'before' => '<div class="FlexEmbed"><div class="FlexEmbed-ratio FlexEmbed-ratio--16by9"></div>', 'after' => '</div>' ) ) ); ?>

<?php if ( is_singular( get_post_type() ) ) : ?>

          <?php get_template_part( 'partials/single', 'header' ); ?>

          <?php get_template_part( 'partials/single', 'content' ); ?>

          <?php get_template_part( 'partials/single', 'footer' ); ?>

<?php else : // If not viewing a single post. ?>

          <?php get_template_part( 'partials/archive', 'header' ); ?>

		<?php if ( has_excerpt() ) : // If the post has an excerpt. ?>

			<?php get_template_part( 'partials/archive', 'content' ); ?>

		<?php elseif ( empty( $video ) ) : // Else, if the post does not have a video. ?>

			<?php get_template_part( 'partials/single', 'content' ); ?>

			<?php get_template_part( 'partials/archive', 'footer' ); ?>

		<?php endif; // End excerpt/video checks. ?>

<?php endif; // End single post check. ?>

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
