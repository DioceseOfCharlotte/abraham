<?php
/**
 * Template Filters.
 *
 * @package Abraham
 */

add_filter( 'hybrid_content_template_hierarchy', 'abe_template_hierarchy' );
add_filter( 'login_redirect', 'abe_login_redirect', 10, 3 );
add_action( 'login_enqueue_scripts', 'abe_login_logo' );
add_filter( 'login_headerurl', 'abe_login_logo_url' );
add_filter( 'login_headertitle', 'abe_login_logo_url_title' );
add_filter( 'excerpt_more', 'abe_excerpt_more' );
add_filter( 'excerpt_length', 'abe_excerpt_length' );
add_filter( 'get_custom_logo', 'abe_custom_logo' );
add_filter( 'edit_post_link', 'abe_edit_post_link' );

/**
 * Add templates to hybrid_get_content_template()
 */
function abe_template_hierarchy( $templates ) {
	$post_type = get_post_type();
	$post_format = get_post_format() ? get_post_format() : 'standard';

	if ( is_search() ) {
		$templates = array_merge( array( 'content/search.php' ), $templates );
	} elseif ( is_single( get_the_ID() ) ) {
		$templates = array_merge(
			array(
				"content/single-{$post_type}.php",
				"content/single-{$post_format}.php",
				'content/single.php',
			), $templates
		);
	}

	return $templates;
}

function abe_login_logo() {
	if ( ! has_custom_logo() ) { return; }

	$bg_image = get_background_image();
	$logo_image = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ) ); ?>

		<style id="login-custom-logo">
			body.login {
				background-image: url(<?php echo $bg_image ?>);
				background-size: cover;
			}
			#login:after {
			    content: "";
			    background-color: #fff;
			    width: 100%;
			    height: 100%;
			    position: absolute;
			    top: 0;
			    left: 0;
			    opacity: .9;
			    z-index: -1;
			}
			#login h1 a {
				background-image: url(<?php echo $logo_image ?>);
			}
			#backtoblog {
				display: none;
			}
			.login .login-links {
				width: 272px;
				margin: 12px auto 0;
				font-size: 13px;
			}
			.login a {
				text-decoration: none;
				color: #555d66;
			}
		</style>
	<?php }

function abe_login_logo_url() {
	return home_url();
}


function abe_login_logo_url_title() {
	ob_start();
	bloginfo( 'name' );
	return ob_get_clean();
}

function abe_login_redirect( $url, $request, $user ) {
	return $request;
}

/**
 * Clean up the_excerpt().
 */
function abe_excerpt_more() {
	return '<a class="btn btn-sm u-p0 u-round u-mx1 u-h3 u-opacity u-lh-1 u-text-2 btn-readmore" href="' . get_permalink() . '">' . abe_get_svg( 'ellipsis-circle', 'sm' ) . '</a>';
}

/**
 * Define the_excerpt() character length.
 */
function abe_excerpt_length( $length ) {
	return 40;
}

function abe_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
			'class'    => 'custom-logo',
			'itemprop' => 'logo',
		)
	);
	return $html;
}

/**
 * Customize the html of the edit link
 *
 * @param string $output Link html.
 */
function abe_edit_post_link( $output ) {
	$output = str_replace( 'class="post-edit-link"', 'class="post-edit-link btn btn-round u-bg-frost-4 u-text-color u-border u-b-grey u-hover-white u-abs u-right0 u-bottom0"', $output );
	return $output;
}



function abe_get_picture_source( $post_id = '', $args = array() ) {
	$post_id   = empty( $post_id ) ? get_the_ID() : $post_id;

	$defaults = array(
		'size'   => 'thumbnail',
		'class'   => 'src-img',
		'thumb_url' => get_the_post_thumbnail_url( $post_id ),
		'thumb_id'  => get_post_thumbnail_id( $post_id ),
	);

	$args = wp_parse_args( $args, $defaults );

	$thumb_base_url = rtrim( $args['thumb_url'], 'jpengifco' );
	$webp_url = "{$thumb_base_url}webp";
	//$webp_dir = wp_parse_url( $webp_url );
	//$webp_path = untrailingslashit( ABSPATH ) . $webp_dir['path'];

	$thumb_src = wp_get_attachment_image_src( $args['thumb_id'], $args['size'] );

	$upload_dir = wp_upload_dir();

	$replace = array(
	home_url( $upload_dir['baseurl'] ),
	$upload_dir['baseurl'],
	);

	$image_abs = str_replace( $replace, '', $webp_url );

	if ( file_exists( trailingslashit( $upload_dir['basedir'] ) . $image_abs ) ) { ?>
		<source srcset="<?php echo $webp_url ?>" class="picture-image webp-image <?php echo $args['class'] ?>" width="<?php echo $thumb_src['1'] ?>" height="<?php echo $thumb_src['2'] ?>" type="image/webp">
		<?php } ?>
		<img src="<?php echo $args['thumb_url'] ?>" class="picture-image <?php echo $args['class'] ?>" width="<?php echo $thumb_src['1'] ?>" height="<?php echo $thumb_src['2'] ?>">
	<?php }
