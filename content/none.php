<?php
/**
 * The template part for displaying a message when posts cannot be found.
 *
 * @package Abraham
 */
?>

<article class="entry">

		<?php if ( is_search() ) : ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing found', 'saga' ); ?></h1>
		</header><!-- .entry-header -->

			<p><?php _e( 'Sorry, but nothing matched your search. Perhaps try some different search terms.', 'abraham' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

<h4><?php _e('It looks like this was the result of either:', 'abraham'); ?></h4>
<ul>
  <li><?php _e('a mistyped address', 'abraham'); ?></li>
  <li><?php _e('an out-of-date link', 'abraham'); ?></li>
</ul>

			<p><?php _e( 'Perhaps one of the links below or a search will help?', 'abraham' ); ?></p>
			<p><?php get_search_form(); ?></p>
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<?php
				$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'abraham' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2> $archive_content" );
				?>

				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

		<?php endif; ?>
</article><!-- .no-results -->
