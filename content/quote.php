<?php
/**
 * Quote post format template part.
 *
 * @package abraham
 */
?>
<section <?php hybrid_attr('post'); ?>>
	<div class="blockquote">
		<?php tha_entry_content_before(); ?>
		<?php the_content(); ?>
		<?php tha_entry_content_after(); ?>
	</div>
</section>
