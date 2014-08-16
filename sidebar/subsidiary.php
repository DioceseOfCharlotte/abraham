<?php if ( is_active_sidebar( 'subsidiary' ) ) : // If the sidebar has widgets. ?>

	<aside class="Sidebar Footer-top grid"<?php hybrid_attr( 'sidebar', 'subsidiary' ); ?>>

  <div class="wrap-flex">

		<?php dynamic_sidebar( 'subsidiary' ); // Displays the subsidiary sidebar. ?>

  </div>

	</aside><!-- #sidebar-subsidiary -->

<?php endif; // End widgets check. ?>