<?php
/**
 * Sidebar Footer Template.
 *
 * @package Abraham
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
} ?>

<aside <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
	<?php dynamic_sidebar( 'footer' ); ?>
</aside>
