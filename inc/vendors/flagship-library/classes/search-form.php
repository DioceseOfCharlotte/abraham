<?php
/**
 * The default WordPress search form is lacking in terms of accessibility.
 * In order to bring it into compliance with WCAG we need to make a few changes.
 * This class adds some aria labels and a unique ID to each search form instance.
 * It also applies some filters which can be used to control the output of the
 * search form.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.0.0
 */

/**
 * Flagship Search Form Class.
 */
class Flagship_Search_Form {

	protected $id;

	/**
	 * Get the search form elements and return them as a single string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_form() {
		return sprintf(
			'<form class="search-form" method="get" action="%s" role="search">%s</form>',
			esc_url( home_url( '/' ) ),
			$this->get_label() . $this->get_input() . $this->get_button()
		);
	}

	/**
	 * Get the search form label.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function get_label() {
		$label = apply_filters( 'flagship_search_form_label', __( 'Search site', 'flagship-library' ) );

		return sprintf(
			'<label for="%s" class="screen-reader-text">%s</label>',
			esc_attr( $this->get_id() ),
			esc_attr( $label )
		);
	}

	/**
	 * Get the search form input field.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function get_input() {
		$value = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : '';
		$placeholder = apply_filters( 'flagship_search_text', __( 'Search this website', 'flagship-library' ) );

		return sprintf(
			'<input type="search" name="s" id="%s" placeholder="%s" autocomplete="off" value="%s" />',
			esc_attr( $this->get_id() ),
			esc_attr( $placeholder ),
			esc_attr( $value )
		);
	}

	/**
	 * Get the search form button element.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function get_button() {
		return sprintf(
			'<button type="submit" aria-label="%1$s"><span class="screen-reader-text">%2$s</span></button>',
			esc_attr( apply_filters( 'flagship_search_button_label', __( 'Search', 'flagship-library' ) ) ),
			esc_attr( apply_filters( 'flagship_search_button_text', __( 'Search', 'flagship-library' ) ) )
		);
	}

	/**
	 * Generate a unique ID for each search form.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function get_id() {
		if ( ! isset( $this->id ) ) {
			$this->id = uniqid( 'searchform-' );
		}

		return $this->id;
	}
}
