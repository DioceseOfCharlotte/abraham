<?php
/**
 * The main template file.
 *
 * @package abraham
 */

get_header(); ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( !is_front_page() && !is_singular() && !is_404() ) : ?>

		<?php kit_loop_meta(); ?>

	<?php endif; // End check for multi-post page. ?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

			<?php if ( is_singular() ) : ?>

				<?php comments_template( '', true ); ?>

			<?php endif; // End check for single post. ?>

		<?php endwhile; // End found posts loop. ?>

		<?php locate_template( array( 'misc/loop-nav.php' ), true ); ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); ?>