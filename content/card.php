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

			<?php
			if ( $video ) {
				echo $video;

			} else {
				get_template_part( 'components/img', 'hd' );
			}
			?>

		<header <?php hybrid_attr( 'entry-header' ); ?>>

			<?php arch_title(); ?>

		</header>

		<?php arch_excerpt(); ?>

</article>

<?php
