<?php
/**
 * Flag Component Template.
 *
 * @package abraham
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php get_template_part( 'components/img', 'thumb' ); ?>

	<div class="flag-body u-flex u-flex-wrap u-flexed-auto">
		<?php tha_entry_top(); ?>
		<?php arch_title(); ?>
		<?php tha_entry_content_before(); ?>
		<?php arch_excerpt(); ?>
		<?php tha_entry_content_after(); ?>
	<?php edit_post_link('<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>'); ?>
		<?php tha_entry_bottom(); ?>
	</div>

</article>
