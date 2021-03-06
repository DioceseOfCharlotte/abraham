<?php
/**
 * Displays header media
 *
 * @package Abraham
 */
?>
<?php
if ( ! abe_custom_header_image() ) {
	return;
}
?>

<div class="custom-header-wrap">

		<picture class="custom-header-media">
			<?php
			echo abe_get_picture_source(
				abe_get_id(),
				array(
					'size'      => 'abe-hd-lg',
					'thumb_url' => abe_custom_header_image(),
					'decor'     => true,
				)
			);
			?>
		</picture>

</div><!-- .custom-header -->
