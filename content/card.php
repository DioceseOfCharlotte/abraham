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

	<?php if ( $video ) {
		echo $video;
	} else {
		get_template_part( 'components/img', 'hd' );
	} ?>

	<?php arch_title(); ?>
	<?php arch_excerpt(); ?>
	<?php get_template_part( 'components/entry', 'footer' ); ?>

	<?php tha_entry_bottom(); ?>

</article>

<?php
