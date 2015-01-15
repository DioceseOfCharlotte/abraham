<?php
/**
 * The search template file.
 *
 * @package Abraham
 */

get_header(); ?>

<div id="primary" class="content-area">

	<?php tha_content_before(); ?>

	<main <?php hybrid_attr( 'content' ); ?>>

	<?php tha_content_top(); ?>

		<header <?php hybrid_attr( 'loop-meta' ); ?>>
			<?php get_search_form(); ?>
			<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php printf( __( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

	<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content/search' );

			endwhile; // End loop.

			get_template_part( 'partials/posts', 'pagination' );

		else : //If no content found.

			get_template_part( 'content/none' );

		endif; // End check for posts.

		tha_content_bottom();
	?>

	</main><!-- #main -->

	<?php tha_content_after(); ?>

</div><!-- #primary -->

<?php
get_footer();
