<?php
/**
 * Lists or other non-titled asides.
 *
 * @package abraham
 */
?>
<section <?php hybrid_attr('post'); ?>>
		<div <?php hybrid_attr('entry-content'); ?>>
			<?php tha_entry_content_before(); ?>
				<?php the_content(); ?>
			<?php tha_entry_content_after(); ?>
		</div>
</section>
