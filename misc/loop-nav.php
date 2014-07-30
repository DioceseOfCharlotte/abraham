<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<div class="loop-nav">
		<?php previous_post_link( '<div class="prev">' . __( 'Previous Post: %link', 'abraham' ) . '</div>', '%title' ); ?>
		<?php next_post_link(     '<div class="next">' . __( 'Next Post: %link',     'abraham' ) . '</div>', '%title' ); ?>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php loop_pagination(
		array( 
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'abraham' ), 
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'abraham' )
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>