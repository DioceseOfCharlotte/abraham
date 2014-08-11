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