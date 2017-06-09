<?php
/**
 * Template used mostly for documents.
 *
 * @package abraham
 */

?>
<?php $doc_link = wp_get_attachment_url( get_the_id() ); ?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_excerpt() ) : // If the image has an excerpt/caption. ?>

		<?php $src = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>

		<?php echo img_caption_shortcode( array( 'align' => 'aligncenter', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) ); ?>

	<?php else : // If the image doesn't have a caption. ?>

		<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>

	<?php endif; // End check for image caption. ?>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>
