<?php
/**
 * Displays header media
 *
 * @package Abraham
 */
$queried_object_id = get_queried_object_id();
?>
<div class="custom-header">

		<picture class="custom-header-media u-tinted-image">
			<?php echo abe_get_picture_source( get_the_ID(),
			array(
				'size'   => 'abe-hd-lg',
				'thumb_url' => abe_custom_header_image( 'abe-hd-lg' ),
			)); ?>
		</picture>

</div><!-- .custom-header -->
