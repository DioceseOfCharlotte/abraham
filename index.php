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

	<?php
		tha_content_top();

		if ( !is_front_page() && !is_singular() ) :

			get_template_part( 'partials/loop', 'meta' );

		endif; // End check for multi-post page.

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				hybrid_get_content_template();

				if ( is_singular() ) :

					get_template_part( 'partials/post', 'navigation' );

				  	comments_template( '', true );

				endif; // End check for single post.

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
