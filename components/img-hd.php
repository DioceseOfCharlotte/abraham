<?php

// get_the_image(array(
// 	'size' 				=> 'abe-hd',
// 	'image_class' 		=> 'u-1of1 o-crop__content',
// 	'before'   			=> '<div class="card-img u-overflow-hidden o-crop o-crop--16x9">',
// 	'after' 			=> '</div>',
// 	'attachment' 		=> false,
// 	'link_to_post' 		=> false,
// ));
//

//function get_picture_thumb {
$post_id   = empty( $post_id ) ? get_the_ID() : $post_id;
$thumb_url = get_the_post_thumbnail_url( $post_id, 'abe-hd' );
$thumb_base_url = rtrim( $thumb_url, 'jpengifco' );
$webp_url = "{$thumb_base_url}webp";
$webp_dir = wp_parse_url( $webp_url );
$webp_path = untrailingslashit( ABSPATH ) . $webp_dir['path'];

$thumb_id = get_post_thumbnail_id( $post_id );
$thumb_src = wp_get_attachment_image_src( $thumb_id, 'abe-hd' );

$upload_dir = wp_upload_dir();

$replace = array(
	home_url( $upload_dir['baseurl'] ),
	$upload_dir['baseurl'],
);

$image_abs = str_replace( $replace, '', $webp_url );

if ( has_post_thumbnail() ) : ?>
<picture class="card-img u-overflow-hidden o-crop o-crop--16x9">
	<?php if ( file_exists( trailingslashit( $upload_dir['basedir'] ) . $image_abs ) ) { ?>
	<source srcset="<?php echo $webp_url ?>" width="<?php echo $thumb_src['1'] ?>" height="<?php echo $thumb_src['2'] ?>" type="image/webp">
	<?php } ?>
	<?php echo get_the_post_thumbnail( $post_id, 'abe-hd', array( 'class' => 'u-1of1 o-crop__content' ) ); ?>
</picture>
<?php endif; ?>
