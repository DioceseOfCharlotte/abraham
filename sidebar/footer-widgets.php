<?php
/**
 * The sidebar containing the footer-widgets widget area.
 *
 * @package kit
 */

if ( ! is_active_sidebar( 'footer' ) ) {
		return;
}
?>
	<aside <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
		<?php dynamic_sidebar( 'footer' ); ?>
	</aside><!-- #sidebar-footer-widgets -->
