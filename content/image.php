<?php
/**
 * @package Abraham
 */
?>

<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

	<?php
		// Display a featured image if we can find something to display.
		get_the_image(
			array(
				'size'          => 'abraham-full',
				'scan'          => true,
				'caption'       => false,
				'order'         => array( 'featured', 'scan_raw', 'scan', 'attachment', ),
				'before'        => '<div class="featured-media image">',
				'after'         => '</div>',
			)
		);
	?>

<?php if ( is_singular( get_post_type() ) ) : ?>

          <?php get_template_part( 'partials/single', 'header' ); ?>

          <?php get_template_part( 'partials/single', 'content' ); ?>

          <?php get_template_part( 'partials/single', 'footer' ); ?>

<?php else : // If not viewing a single post. ?>

          <?php get_template_part( 'partials/archive', 'header' ); ?>

          <?php get_template_part( 'partials/archive', 'content' ); ?>

          <?php get_template_part( 'partials/archive', 'footer' ); ?>

<?php endif; // End single post check. ?>

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
