<?php
/**
 * Cards Component Template.
 *
 * @package abraham
 */

$video = hybrid_media_grabber(
	array(
		'type'        => 'video',
		'split_media' => true,
	)
);
?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php tha_entry_top(); ?>

	<?php get_template_part( 'components/img', 'thumb' ); ?>
	<div class="flag-body u-flexed-auto">
		<header <?php hybrid_attr( 'entry-header' ); ?>>

			<?php arch_title(); ?>

		</header>

		<?php arch_excerpt(); ?>
	</div>

	<?php tha_entry_bottom(); ?>

</article>

<?php
