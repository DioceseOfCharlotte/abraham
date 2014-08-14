<?php 
/**
 * Template Name: Hero Home
 */

get_header(); // Loads the header.php template. ?>

<main id="content" class="home-site-main" itemprop="mainContentOfPage">

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php if ( hybrid_post_has_content() ) : // Check if the page has content. ?>

						<?php the_content(); ?>

						<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

						<style type="text/css" id="slider-background-css">.flexslider-background { 
							background: url(<?php echo $image[0]; ?>) no-repeat center center fixed; 
  						-webkit-background-size: cover;
  						-moz-background-size: cover;
  						-o-background-size: cover;
  						background-size: cover;
  						 }</style>
  						 <?php endif; ?>

				<article <?php hybrid_attr( 'post' ); ?>>

					<?php hybrid_get_sidebar( 'featured' ); // Loads the sidebar/subsidiary.php template. ?>

				</article><!-- .entry -->

			<?php else : // If the page doesn't have content. ?>

				<?php hybrid_get_sidebar( 'featured' ); // Loads the sidebar/subsidiary.php template. ?>

			<?php endif; // End check for page content. ?>

		<?php endwhile; // End found posts loop. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>