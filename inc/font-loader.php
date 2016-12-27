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

	wp_enqueue_style( 'abe_google_font', 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:500,600,600i|Open+Sans:300,300i,400,400i,600,600i' );

	wp_enqueue_style( 'abe_font_awesome', 'https://use.fontawesome.com/1397c1e607.css' );

	wp_enqueue_script(
		'font_face',
		trailingslashit( get_template_directory_uri() ) . 'js/vendors/fontfaceobserver.js',
		false, false, true
	);
	wp_add_inline_script( 'font_face', 'var fontA = new FontFaceObserver("Cormorant Garamond");var fontB = new FontFaceObserver("Open Sans");fontA.load().then(function () {document.documentElement.className += " fontA";});fontB.load().then(function () {document.documentElement.className += " fontB";});' );

}

function abe_display_font() {
?>

	<style type="text/css">
		.u-text-display,.u-dropcap::first-letter {
			font-weight: normal;
		}
		.fontB body, .fontB .u-text-read {
			font-family: 'Open Sans', sans-serif;
		}
		.fontA .u-text-display,.fontA .u-dropcap::first-letter {
			font-family: "Cormorant Garamond", serif;
			font-weight: 600;
		}
	</style>
<?php }
