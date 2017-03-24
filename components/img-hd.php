<?php




if ( has_post_thumbnail() ) : ?>
<picture class="card-img u-overflow-hidden o-crop o-crop--16x9">

	<?php echo abe_get_picture_source(); ?>

	<?php echo get_the_post_thumbnail( get_the_ID(), 'abe-hd', array( 'class' => 'u-1of1 o-crop__content' ) ); ?>
</picture>
<?php endif; ?>
