<?php
/**
 * The template for displaying featured content
 *
 * @package abe
 */

/**
 * Add this to the content template where you want Featured Posts to show.
 *
 *		 get_template_part( 'components/featured', 'entry' );
 */

$featured_posts = abe_get_featured_posts();
if ( empty( $featured_posts ) ) {
	return;
}
?>

<div id="featured-content" class="featured-content">
	<div class="featured-content-inner">
		<?php
			foreach ( $featured_posts as $post ) {
				setup_postdata( $post );

				 // Include the featured content template.
				get_template_part( 'content/featured' );
			}

			wp_reset_postdata();
		?>
	</div><!-- .featured-content-inner -->
</div><!-- #featured-content -->
