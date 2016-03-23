<?php
if (!is_active_sidebar('primary')) {
	return;
} ?>

<?php tha_sidebars_before(); ?>

	<aside <?php hybrid_attr('sidebar', 'primary'); ?>>
		<?php tha_sidebar_top(); ?>
		<?php dynamic_sidebar('primary'); ?>
		<?php tha_sidebar_bottom(); ?>
	</aside>

<?php tha_sidebars_after(); ?>
