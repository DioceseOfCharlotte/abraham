<?php
/**
 * Nothing found template.
 *
 * @package abraham
 */

?>
<article class="u-fit o-cell u-bg-white u-mb3 u-1of1 u-br u-shadow2">

	<div <?php hybrid_attr( 'entry-content' ); ?>>

		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search. Perhaps try again with some different keywords.', 'abraham' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'abraham' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</article><!-- .no-results -->
