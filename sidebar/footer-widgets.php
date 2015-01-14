<?php
/**
 * The sidebar containing the footer-widgets widget area.
 *
 * @package kit
 */

if ( ! is_active_sidebar( 'footer-widgets' ) ) {
	return;
}
?>

<aside <?php hybrid_attr( 'sidebar', 'footer-widgets' ); ?>>
	<?php dynamic_sidebar( 'footer-widgets' ); ?>
</aside><!-- #sidebar-footer-widgets -->
