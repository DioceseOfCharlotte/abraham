<?php
/**
 * Nothing found template.
 *
 * @package abraham
 */

?>
<article class="u-fit o-cell u-bg-white u-text-center u-mb3 u-1of1 u-br u-shadow2">

	<div <?php hybrid_attr( 'entry-content' ); ?>>

		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search. Perhaps try again with some different keywords.', 'abraham' ); ?></p>
			<p class="u-1of1"><?php get_search_form(); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'The page you were looking for isn\'t here. Perhaps searching can help.', 'abraham' ); ?></p>
			<div class="u-1of1"><?php get_search_form(); ?></div>

		<?php endif; ?>

	</div><!-- .page-content -->
</article><!-- .no-results -->
