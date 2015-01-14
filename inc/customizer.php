<?php
/**
 * Scratch Theme Customizer
 *
 * @package Scratch
 */


/* Theme Customizer setup. */
add_action( 'customize_register', 'scratch_customize_register' );

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function scratch_customize_register( $wp_customize ) {
  
  /* Load JavaScript files. */
	add_action( 'customize_preview_init', 'scratch_customize_scripts' );
	
	/* Add postMessage support for site title and description for the Theme Customizer. */
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_image' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_image' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_position_x' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_repeat' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';
	
	
	/* Remove the WordPress background image control. */
	$wp_customize->remove_control( 'background_image' );
	
	/* Add our custom background image control. */
	$wp_customize->add_control( new Hybrid_Customize_Control_Background_Image( $wp_customize ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function scratch_customize_scripts() {
  
	$suffix = hybrid_get_min_suffix();
	
	wp_enqueue_script( 'scratch-customize', trailingslashit( get_template_directory_uri() ) . "js/customizer{$suffix}.js", array( 'customize-preview' ), null, true );
}
