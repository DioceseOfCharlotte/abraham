<?php
/**
 * @package Scratch
 */
?>

		<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>
				<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		<?php else : // If not viewing a single post. ?>

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

		<?php endif; // End single post check. ?>
		