<?php
/**
 * Abraham Theme Customizer
 *
 * @package Abraham
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abraham_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'abraham_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function abraham_customize_preview_js() {
	wp_enqueue_script( 'abraham_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'abraham_customize_preview_js' );



function abraham_customize_css() {
?>
<style type="text/css">

#customize-control-theme-layout-control input[value="1c"]:after {
  content: '';
  width: 22px;
  height: 10px;
  background-color: #ddd;
  display: inline-block;
  margin-left: 5px;
  margin-top: -6px;
}

#customize-control-theme-layout-control input[value="1c-narrow"]:before, #customize-control-theme-layout-control input[value="1c"]:before {
	content: "\f134";
}
#customize-control-theme-layout-control input[value="2c-l"]:before {
	content: "\f135";
}
#customize-control-theme-layout-control input[value="2c-r"]:before {
	content: "\f136";
}
#customize-control-theme-layout-control input[type="radio"] {
	font-family: dashicons;
	font-size: 32px;
  	margin-right: 20px;
	color: #ddd;
	border: 0;
	line-height: 0;
	height: 0;
	width: 0;
}

#customize-control-theme-layout-control input[type="radio"]:checked:before {
	color: #888;
	text-indent: 0;
	-webkit-border-radius: 0;
  border-radius: 0;
  font-size: 32px;
  width: 0;
  height: 0;
   margin: 0;
  line-height: 0;
  background: none;
}

#customize-control-theme-layout-control input[value="1c"]:checked:after {
		background-color: #888;
	}
</style>
<?php
}
add_action( 'customize_controls_init', 'abraham_customize_css' );

function abraham_admin_styles() {
?>
<style type="text/css">
#theme-layouts-post-meta-box input[value="default"]:before {
	content: "\f111";
}

#theme-layouts-post-meta-box input[value="1c"]:after {
  content: '';
  width: 22px;
  height: 10px;
  background-color: #ddd;
  display: inline-block;
  position: absolute;
  left: 17px;
  margin-top: -6px;
}

#theme-layouts-post-meta-box input[value="1c-narrow"]:before, #theme-layouts-post-meta-box input[value="1c"]:before {
	content: "\f134";
}
#theme-layouts-post-meta-box input[value="2c-l"]:before {
	content: "\f135";
}
#theme-layouts-post-meta-box input[value="2c-r"]:before {
	content: "\f136";
}
#theme-layouts-post-meta-box input[type="radio"] {
	font-family: dashicons;
	font-size: 32px;
  	margin-right: 20px;
	color: #ddd;
	border: 0;
	line-height: 0;
	height: 0;
	width: 0;
}

#theme-layouts-post-meta-box input[value="1c"]:checked:after{
	background-color: #888;
}

#theme-layouts-post-meta-box input[type=radio]:checked:before {
	color: #888;
	text-indent: 0;
	-webkit-border-radius: 0;
  border-radius: 0;
  font-size: 32px;
  width: 0;
  height: 0;
   margin: 0;
  line-height: 0;
  background: none;
}
#theme-layouts-post-meta-box li {
  margin-bottom: 15px;
}
</style>
<?php
}
add_action( 'admin_print_styles', 'abraham_admin_styles' );
