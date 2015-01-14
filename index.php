<?php
/**
 * The main template file.
 *
 * @package Scratch
 */

get_header(); ?>

	<div id="primary" class="content-area">

	  <?php tha_content_before(); ?>

		<main <?php hybrid_attr( 'content' ); ?>>

		<?php tha_content_top(); ?>

		<?php if ( !is_front_page() && !is_singular() && !is_404() ) : ?>

			<?php scratch_loop_meta(); ?>

		<?php endif; // End check for multi-post page. ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

				<?php get_template_part( 'partials/post', 'navigation' ); ?>

				<?php if ( is_singular() ) :
				  comments_template( '', true );
				endif; // End check for single post. ?>

			<?php endwhile; // End loop. ?>

			<?php get_template_part( 'partials/posts', 'pagination' ); ?>

		<?php else : //If no content found. ?>

			<?php get_template_part( 'content/none' ); ?>

		<?php endif; // End check for posts. ?>

		<?php tha_content_bottom(); ?>

		</main><!-- #main -->

		<?php tha_content_after(); ?>

	</div><!-- #primary -->

<?php hybrid_get_sidebar( 'primary' ); ?>
<?php
get_footer();
