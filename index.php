<?php
/**
 * The main template file.
 *
 * @package Abraham
 */

get_header(); ?>
<?php hybrid_get_sidebar( 'primary' ); ?>

	<div id="primary" class="content-area">
		<main <?php hybrid_attr( 'content' ); ?>>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php hybrid_get_content_template(); ?>

			<?php endwhile; ?>

			<?php abraham_loop_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content/error.php' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php hybrid_get_sidebar( 'secondary' ); ?>
<?php get_footer(); ?>
