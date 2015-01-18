<?php
/**
 * @package Abraham
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

	<?php echo ( $audio = hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true, 'before' => '<div class="featured-media">', 'after' => '</div>' ) ) ); ?>

<?php if ( is_singular( get_post_type() ) ) : ?>

        	<?php get_template_part( 'partials/single', 'header' ); ?>

          <?php get_template_part( 'partials/single', 'content' ); ?>

          <?php get_template_part( 'partials/single', 'footer' ); ?>

<?php else : // If not viewing a single post. ?>

		<?php if ( has_excerpt() ) : // If the post has an excerpt. ?>

			<?php get_template_part( 'partials/archive', 'content' ); ?>

		<?php elseif ( empty( $audio ) ) : // Else, if the post does not have audio. ?>

			<?php get_template_part( 'partials/single', 'content' ); ?>

		<?php endif; // End excerpt/audio checks. ?>

<?php endif; // End single post check. ?>

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
