<?php
/**
 * Abraham Theme Customizer
 *
 * @package Abraham
 */

if ( file_exists ( get_template_directory() . '/inc/vendors/customizer-library/customizer-library.php' ) ) :

// Helper library for the theme customizer.
require get_template_directory() . '/inc/vendors/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/inc/customizer/options.php';

// Custom color functions.
require get_template_directory() . '/inc/customizer/colors.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/inc/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/inc/customizer/mods.php';

else :

add_action( 'customizer-library-notices', 'demo_customizer_library_notice' );

endif;

function demo_customizer_library_notice() {

	_e( '<p>Notice: The "customizer-library" sub-module is not loaded.</p><p>Please add it to the "inc" directory: <a href="https://github.com/devinsays/customizer-library">https://github.com/devinsays/customizer-library</a>.</p><p>The demo, including submodules, can also be installed via Git: "git clone --recursive git@github.com:devinsays/customizer-library-demo".</p>', 'demo' );

}
