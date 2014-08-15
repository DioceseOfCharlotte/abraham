<?php if ( is_active_sidebar( 'featured' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'featured' ); ?>>

  <div class="wrap-flex">

		<?php dynamic_sidebar( 'featured' ); // Displays the featured sidebar. ?>

  </div>

	</aside><!-- #sidebar-featured -->

<?php endif; // End widgets check. ?>