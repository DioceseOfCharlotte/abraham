<?php

function abe_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}


/**
 * Featured Posts
 */
function abe_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'abe_get_featured_posts', array() );
	if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
		return true;
	}
	return false;
}
function abe_get_featured_posts() {
	return apply_filters( 'abe_get_featured_posts', false );
}

/**
 * SVG
 */
function abe_do_svg( $icon='cog', $size='sm' ) { ?>
<div class="icon-<?= $size ?>">
	<?php include( locate_template( 'images/icons/'.esc_attr( $icon ).'.svg' ) ); ?>
</div>
<?php }
