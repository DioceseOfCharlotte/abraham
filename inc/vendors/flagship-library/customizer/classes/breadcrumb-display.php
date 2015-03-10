<?php
/**
 * Options for displaying breadcrumbs for use in the WordPrss customizer.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.1.0
 */

/**
 * Our Breadcrumb display class for managing breadcrumbs through the Customizer.
 *
 * @package FlagshipLibrary
 */
class Flagship_Breadcrumb_Display extends Flagship_Customizer_Base {

	protected $section = 'flagship_breadcrumbs';

	/**
	 * Register our customizer breadcrumb options for the parent class to load.
	 *
	 * @since  1.1.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function register( $wp_customize ) {

		$wp_customize->add_section(
			$this->section,
			array(
				'title'       => __( 'Breadcrumbs', 'flagship-library' ),
				'description' => __( 'Choose where you would like breadcrumbs to display.', 'flagship-library' ),
				'priority'    => 110,
				'capability'  => $this->capability,
			)
		);

		$priority = 10;

		foreach ( $this->get_options() as $breadcrumb => $setting ) {

			$wp_customize->add_setting(
				$breadcrumb,
				array(
					'default'           => $setting['default'],
					'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
				)
			);

			$wp_customize->add_control(
				$breadcrumb,
				array(
					'label'    => $setting['label'],
					'section'  => $this->section,
					'type'     => 'checkbox',
					'priority' => $priority++,
				)
			);
		}
	}

	/**
	 * An array of breadcrumb locations.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return array $breadcrumbs
	 */
	public function get_options() {
		return apply_filters( 'flagship_breadcrumb_options', array(
			'flagship_breadcrumb_single' => array(
				'default'  => 0,
				'label'    => __( 'Single Entries', 'flagship-library' ),
			),
			'flagship_breadcrumb_pages' => array(
				'default'  => 0,
				'label'    => __( 'Pages', 'flagship-library' ),
			),
			'flagship_breadcrumb_blog_page' => array(
				'default'  => 0,
				'label'    => __( 'Blog Page', 'flagship-library' ),
			),
			'flagship_breadcrumb_archive' => array(
				'default'  => 0,
				'label'    => __( 'Archives', 'flagship-library' ),
			),
			'flagship_breadcrumb_404' => array(
				'default'  => 0,
				'label'    => __( '404 Page', 'flagship-library' ),
			),
			'flagship_breadcrumb_attachment' => array(
				'default'  => 0,
				'label'    => __( 'Attachment/Media Pages', 'flagship-library' ),
			),
		) );
	}

	/**
	 * Deprecated wrapper method for backwards compatbility.
	 *
	 * @deprecated use get_options instead.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return array $breadcrumbs
	 */
	public function get_breadcrumb_options() {
		return $this->get_options();
	}

}
