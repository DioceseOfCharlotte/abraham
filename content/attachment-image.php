<?php
/**
 * @package Abraham
 */
?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_attachment() ) : // If viewing a single attachment. ?>

		<?php if ( has_excerpt() ) : // If the image has an excerpt/caption. ?>

			<?php $src = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>

			<?php echo img_caption_shortcode(
				[
					'align' => 'aligncenter',
					'width' => esc_attr( $src[1] ),
					'caption' => get_the_excerpt()
				],
				wp_get_attachment_image( get_the_ID(), 'full', false )
			); ?>

		<?php else : // If the image doesn't have a caption. ?>

			<?php
				echo wp_get_attachment_image( get_the_ID(), 'full', false,
					[
						'class' => 'aligncenter'
					]
				);
			?>

		<?php endif; // End check for image caption. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">
				<span class="image-sizes"><?php printf( __( 'Sizes: %s', 'kit' ), hybrid_get_image_size_links() ); ?></span>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<?php get_template_part( 'partials/single', 'content' ); ?>

		<?php get_template_part( 'partials/single', 'footer' ); ?>

	<?php else : // If not viewing a single post. ?>

	  <?php get_the_image(); ?>

		<?php get_template_part( 'partials/archive', 'header' ); ?>

		<?php get_template_part( 'partials/archive', 'content' ); ?>

	<?php endif; // End single attachment check. ?>

</article><!-- .entry -->

<?php if ( is_attachment() ) : // If viewing a single attachment. ?>

	<div class="attachment-meta">

		<div class="media-info image-info">

			<h3 class="attachment-meta-title"><?php _e( 'Image Info', 'kit' ); ?></h3>

			<?php hybrid_media_meta(); ?>

		</div><!-- .media-info -->

		<?php
			$gallery = gallery_shortcode(
				[
					'columns' => 4,
					'numberposts' => 8,
					'orderby' => 'rand',
					'id' => get_queried_object()->post_parent,
					'exclude' => get_the_ID()
				]
			);
			?>

		<?php if ( !empty( $gallery ) ) : // Check if the gallery is not empty. ?>

			<div class="image-gallery">
				<h3 class="attachment-meta-title"><?php _e( 'Gallery', 'kit' ); ?></h3>
				<?php echo $gallery; ?>
			</div>

		<?php endif; // End gallery check. ?>

	</div><!-- .attachment-meta -->

<?php endif; // End single attachment check. ?>
