<?php
/**
 * The main template file.
 *
 * @package Abraham
 */

get_header(); ?>

	<div id="primary" class="content-area">

	  <?php tha_content_before(); ?>

		<main <?php hybrid_attr( 'content' ); ?>>

		<?php tha_content_top(); ?>

			<div <?php hybrid_attr( 'loop-meta' ); ?>>
				<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php printf( __( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</div><!-- .page-header -->

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content/search' ); ?>

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
