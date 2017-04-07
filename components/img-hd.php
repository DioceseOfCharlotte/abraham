<?php




if ( has_post_thumbnail() ) : ?>
<picture class="card-img u-overflow-hidden">
	<?php echo abe_get_picture_source( get_the_ID(),
		array(
		'size'   => 'abe-hd',
		'class'   => 'u-1of1',
		'thumb_url' => get_the_post_thumbnail_url( get_the_ID(), 'abe-hd' ),
	)); ?>
</picture>
<?php endif; ?>
