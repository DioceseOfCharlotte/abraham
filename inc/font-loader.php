<?php
/**
 * Overwrite html class selectors.
 *
 * @package Abraham
 */
add_action( 'wp_enqueue_scripts', 'abe_font_scripts' );
add_action( 'wp_head', 'abe_display_font' );

/**
* Enqueue scripts and styles.
*/
function abe_font_scripts() {

wp_enqueue_style( 'abe_google_font', 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,500,600,700|Source+Sans+Pro:300,400,400i,600,600i,700' );

wp_enqueue_style( 'abe_font_awesome', 'https://use.fontawesome.com/1397c1e607.css' );

wp_enqueue_script(
	'font_face',
	trailingslashit( get_template_directory_uri() ) . 'js/vendors/fontfaceobserver.js',
	false, false, true
);
wp_add_inline_script( 'font_face', 'var fontA = new FontFaceObserver("Cormorant Garamond");var fontB = new FontFaceObserver("Source Sans Pro");fontA.load().then(function () {document.documentElement.className += " fontA";});fontB.load().then(function () {document.documentElement.className += " fontB";});' );

}

function abe_display_font() {
	$font_dir = trailingslashit( get_template_directory_uri() ) . 'fonts/'; ?>

	<link rel="preload" href="<?php echo $font_dir ?>cormorant-garamond-regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo $font_dir ?>SourceSansPro-Regular.woff2" as="font" type="font/woff2" crossorigin>

	<style type="text/css">
		@font-face {
			font-family: 'CormorantFB';
			font-style: normal;
			font-weight: 400;
			src:url('<?php echo $font_dir ?>cormorant-garamond-regular.woff2') format('woff2'),
				url('<?php echo $font_dir ?>cormorant-garamond-regular.woff') format('woff');
		}
		@font-face {
		    font-family: 'Source Sans ProFB';
		    src: url('<?php echo $font_dir ?>SourceSansPro-Regular.woff2') format('woff2'),
		         url('<?php echo $font_dir ?>SourceSansPro-Regular.woff') format('woff');
		    font-weight: 400;
		    font-style: normal;

		}
		body, .u-text-read {
			font-family: "Source Sans ProFB", sans-serif;
			font-weight: 400;
		}
		.u-text-display,.u-dropcap::first-letter {
			font-family: CormorantFB, serif;
			font-weight: 400;
		}
		.fontB body, .fontB .u-text-read {
			font-family: "Source Sans Pro", sans-serif;
		}
		.fontA .u-text-display,.fontA .u-dropcap::first-letter {
			font-family: "Cormorant Garamond", serif;
		}
	</style>
<?php }
