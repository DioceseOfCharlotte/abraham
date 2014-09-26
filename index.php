<?php
/**
 * The main template file.
 *
 * @package Abraham
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			// Start the Loop
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php abraham_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content/error.php' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php hybrid_get_sidebar( 'primary' ); ?>
<?php get_footer(); ?>
