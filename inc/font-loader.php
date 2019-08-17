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

	wp_enqueue_style( 'abe_google_font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400|Spectral:400&display=swap' );

	wp_enqueue_script( 'font_face', get_theme_file_uri( 'js/vendors/fontfaceobserver.js' ), false, false, true );

	wp_add_inline_script( 'font_face', get_font_load_script() );

}

function get_font_load_script() {

	return "
	(function () {
	var titleBold = new FontFaceObserver('Spectral', {weight: 400});
	var bodyFont = new FontFaceObserver('Open Sans', {weight: 400});
	var bodyLight = new FontFaceObserver('Open Sans', {weight: 300});
	Promise.all([
		titleBold.load(),
		bodyFont.load(),
		bodyLight.load(),
	]).then(function () {
		document.documentElement.classList.add('fonts-loaded');
		sessionStorage.fontsLoaded = true;
	}).catch(function () {
	  sessionStorage.fontsLoaded = false;
	});
	}());";
}

function abe_display_font() {
	?>
	<script>
		(function () {
			if (sessionStorage.fontsLoaded) {
				document.documentElement.classList.add('fonts-loaded');
			}
		}());
	</script>

	<style type="text/css">
		.fonts-loaded body, .fonts-loaded .u-text-read {
			font-family: 'Open Sans', sans-serif;
		}
		.fonts-loaded .u-text-display,.fonts-loaded .u-dropcap::first-letter {
			font-family: 'Spectral', serif;
			font-weight: normal;
		}
	</style>
	<?php
}
