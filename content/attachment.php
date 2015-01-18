<?php
/**
 * @package Abraham
 */
?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_attachment() ) : // If viewing a single attachment. ?>

		<?php get_template_part( 'partials/single', 'header' ); ?>

		<div class="entry-content">
			<?php hybrid_attachment(); // Function for handling non-image attachments. ?>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<?php get_template_part( 'partials/single', 'footer' ); ?>

	<?php else : // If not viewing a single attachment. ?>

		<?php get_the_image(); ?>

          <?php get_template_part( 'partials/archive', 'header' ); ?>

          <?php get_template_part( 'partials/archive', 'content' ); ?>

	<?php endif; // End single attachment check. ?>

</article><!-- .entry -->