<?php
/**
 * The template for displaying search results pages.
 *
 * @package Abraham
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'abraham' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			// Start the Loop
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content/search' ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'misc/loop-nav.php' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content/error' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php hybrid_get_sidebar( 'primary' ); ?>
<?php get_footer(); ?>
