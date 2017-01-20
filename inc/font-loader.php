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

	//wp_enqueue_script( 'abe_font_awesome', 'https://use.fortawesome.com/11b0b571.js', false, false, false );

	wp_enqueue_script( 'font_face', get_theme_file_uri( 'js/vendors/fontfaceobserver.js' ), false, false, true );

	wp_add_inline_script( 'font_face', get_font_load_script() );

}

function get_font_load_script() {

	return "
	(function () {
	var titleFont = new FontFaceObserver('Cormorant Garamond', {weight: 600});
	var bodyFont = new FontFaceObserver('Open Sans');
	Promise.all([
		titleFont.load(),
		bodyFont.load()
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
		.u-text-display,.u-dropcap::first-letter {
			font-weight: normal;
		}
		.fonts-loaded body, .fonts-loaded .u-text-read {
			font-family: 'Open Sans', sans-serif;
		}
		.fonts-loaded .u-text-display,.fonts-loaded .u-dropcap::first-letter {
			font-family: "Cormorant Garamond", serif;
			font-weight: 600;
		}
	</style>
<?php }
