<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

	<div class="wrap-flex">

			<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

	</div><!-- wrap-flex -->
	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>