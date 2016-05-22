<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
?>

<header <?php hybrid_attr( 'entry-header' ); ?>>

	<h2 <?php hybrid_attr( 'entry-title' ); ?>>
		<a class="entry-title-link u-1of1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
</header>
