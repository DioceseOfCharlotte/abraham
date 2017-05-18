<?php
/**
 * Displays header media
 *
 * @package Abraham
 */
?>
<?php if ( ! abe_custom_header_image() ) {
	return;
} ?>

<div class="custom-header-wrap">

		<picture class="custom-header-media">
			<?php echo abe_get_picture_source( get_the_ID(),
				array(
				'size'   => 'abe-hd-lg',
				'thumb_url' => abe_custom_header_image(),
			)); ?>
		</picture>

</div><!-- .custom-header -->
