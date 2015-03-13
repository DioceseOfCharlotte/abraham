<?php
/**
 * @package Abraham
 */
?>

<?php if ( is_attachment() ) : // If viewing a single attachment. ?>

	<article <?php hybrid_attr( 'post' ); ?>>

		<?php hybrid_attachment(); // Function for handling non-image attachments. ?>

		<?php get_template_part( 'partials/single', 'header' ); ?>

		<?php get_template_part( 'partials/single', 'content' ); ?>

		<?php get_template_part( 'partials/single', 'footer' ); ?>

	</article><!-- .entry -->

	<div class="attachment-meta">

		<div class="media-info">

			<h3><?php _e( 'Audio Info', 'kit' ); ?></h3>

			<?php hybrid_media_meta(); ?>

		</div><!-- .media-info -->

	</div><!-- .attachment-meta -->

<?php else : // If not viewing a single attachment. ?>

	<article <?php hybrid_attr( 'post' ); ?>>

		<?php
			get_the_image( [
				'size' => 'full',
				'order' => [
					'featured',
					'attachment'
				]
			] );
		?>

		<?php get_template_part( 'partials/archive', 'header' ); ?>

		<?php get_template_part( 'partials/archive', 'content' ); ?>

	</article><!-- .entry -->

<?php endif; // End single attachment check. ?>
