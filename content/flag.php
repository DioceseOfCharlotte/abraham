<?php
/**
 * Flag Component Template.
 *
 * @package abraham
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php get_template_part( 'components/img', 'thumb' ); ?>

	<div class="flag-body u-flexed-auto">
		<?php tha_entry_top(); ?>
		<?php arch_title(); ?>
		<?php tha_entry_content_before(); ?>
		<?php arch_excerpt(); ?>
		<?php tha_entry_content_after(); ?>
		<?php get_template_part( 'components/entry', 'footer' ); ?>
		<?php tha_entry_bottom(); ?>
	</div>

</article>
