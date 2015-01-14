<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Scratch
 */

get_header(); ?>

	<div id="primary" class="content-area">

	  <?php tha_content_before(); ?>

		<main <?php hybrid_attr( 'content' ); ?>>

		<?php tha_content_top(); ?>

      <?php tha_entry_before(); ?>

        <article class="entry error-404 not-found">

        	<?php tha_entry_top(); ?>

        	<header class="entry-header">
        		<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'scratch' ); ?></h1>
        	</header><!-- .page-header -->

        	<div class="entry-content">

        		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'scratch' ); ?></p>

        		<?php get_search_form(); ?>

        		<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

        		<?php
        		// Translators: %1$s: smiley
        		$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'scratch' ), convert_smilies( ':)' ) ) . '</p>';
        		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2> $archive_content" );
        		?>

        		<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

        	</div><!-- .entry-content -->

        	<?php tha_entry_bottom(); ?>

        </article><!-- .error-404 -->

<?php tha_entry_after(); ?>

		<?php tha_content_bottom(); ?>

		</main><!-- #main -->

		<?php tha_content_after(); ?>

	</div><!-- #primary -->

<?php hybrid_get_sidebar( 'primary' ); ?>
<?php
get_footer();
