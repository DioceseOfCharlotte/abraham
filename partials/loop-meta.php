<?php
/**
 * @package Abraham
 */
?>

<header <?php hybrid_attr( 'loop-meta' ); ?>>

	<?php if ( is_404() ) : ?>

    	<h1 class="loop-title"><?php _e( 'That page can&rsquo;t be found.', 'abraham' ); ?></h1>

    <?php else : ?>

		<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>

	<?php endif; ?>

	<?php if ( is_category() || is_tax() ) : // If viewing a category or custom taxonomy. ?>

		<?php hybrid_get_menu( 'sub-terms' ); // Loads the menu/sub-terms.php template. ?>

	<?php endif; // End taxonomy check. ?>

	<?php if ( !is_paged() && !is_search() && $desc = hybrid_get_loop_description() ) : // Check if we're on page/1. ?>

		<div <?php hybrid_attr( 'loop-description' ); ?>>
			<?php echo $desc; ?>
		</div><!-- .loop-description -->

	<?php endif; // End paged check. ?>

</header><!-- .loop-meta -->
