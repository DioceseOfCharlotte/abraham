<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Abraham
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
        <div <?php hybrid_attr( 'loop-meta' ); ?>>
        	<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>
        	<?php if ( !is_paged() && $desc = hybrid_get_loop_description() ) : // Check if we're on page/1. ?>
        		<div <?php hybrid_attr( 'loop-description' ); ?>>
        			<?php echo $desc; ?>
        		</div><!-- .loop-description -->
        	<?php endif; // End paged check. ?>
        </div><!-- .loop-meta -->
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php hybrid_get_content_template(); ?>

			<?php endwhile; ?>

			<?php abraham_loop_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php hybrid_get_sidebar( 'primary' ); ?>
<?php get_footer(); ?>
