<?php if ( is_active_sidebar( 'subsidiary' ) ) : ?>

	<aside <?php hybrid_attr( 'sidebar', 'subsidiary' ); ?>>

		<?php dynamic_sidebar( 'subsidiary' ); ?>

	</aside><!-- #sidebar-subsidiary -->

<?php endif; // End widgets check. ?>