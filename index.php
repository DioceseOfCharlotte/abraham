<?php
/**
 * The main template file.
 *
 * @package Abraham
 */

get_header(); ?>

<?php hybrid_get_sidebar( 'primary' ); ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php doc_content_top(); ?>

	<?php if ( !is_front_page() && !is_singular() && !is_404() ) : // If viewing a multi-post page ?>

        <?php abraham_loop_meta(); ?>

    <?php endif; // End check for multi-post page. ?>

	<div <?php hybrid_attr( 'archive_wrap' ); ?>>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php hybrid_get_content_template(); ?>

			<?php endwhile; ?>

				<?php abraham_loop_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content/error' ); ?>

		<?php endif; // End check for posts. ?>
	</div>

	<?php doc_content_bottom(); ?>

</main><!-- #main -->

<?php hybrid_get_sidebar( 'secondary' ); ?>

<?php get_footer(); ?>