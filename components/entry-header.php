<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
?>

<header <?php hybrid_attr( 'entry-header' ); ?>>
	<h2 <?php hybrid_attr( 'entry-title' ); ?>>
		<a class="u-1of1 u-border-b u-b-2 u-inline-flex u-flex-center u-p u-py05" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?><?php abe_do_svg( 'uni-link', '1em' ) ?></a>
	</h2>
</header>
