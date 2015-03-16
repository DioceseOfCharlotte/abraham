<?php
/**
 * General theme helper functions.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.4.0
 */

/**
 * A class to register settings and load templates for author boxes.
 *
 * @package FlagshipLibrary
 */
class Flagship_Author_Box_Admin {

	/**
	 * Get our class up and running!
	 *
	 * @since  1.4.0
	 * @access public
	 * @uses   Flagship_Author_Box::$wp_hooks
	 * @return void
	 */
	public function run() {
		self::wp_hooks();
	}

	/**
	 * Register our actions and filters.
	 *
	 * @since  1.4.0
	 * @access public
	 * @return void
	 */
	private function wp_hooks() {
		add_filter( 'user_contactmethods',      array( $this, 'user_contactmethods' ) );
		add_action( 'show_user_profile',        array( $this, 'user_fields' ) );
		add_action( 'edit_user_profile',        array( $this, 'user_fields' ) );
		add_action( 'personal_options_update',  array( $this, 'meta_save' ) );
		add_action( 'edit_user_profile_update', array( $this, 'meta_save' ) );
	}

	/**
	 * Add additional contact methods for registered users.
	 *
	 * @since  1.4.0
	 * @access public
	 * @param  array $contactmethods Existing contact methods.
	 * @return array $contactmethods Modifed contact methods.
	 */
	public function user_contactmethods( array $contactmethods ) {
		$contactmethods['googleplus'] = __( 'Google+', 'flagship-library' );
		$contactmethods['twitter']    = __( 'Twitter (Without @)', 'flagship-library' );
		$contactmethods['facebook']   = __( 'Facebook', 'flagship-library' );
		return $contactmethods;
	}

	/**
	 * Add fields for author box settings to the user edit screen.
	 *
	 * @since  1.4.0
	 * @access public
	 * @param  $user Object WordPress user object.
	 * @return void
	 */
	public function user_fields( $user ) {
		if ( ! current_user_can( 'edit_users', $user->ID ) ) {
			return false;
		}
		$single_box  = get_the_author_meta( 'flagship_author_box_single',  $user->ID );
		$archive_box = get_the_author_meta( 'flagship_author_box_archive', $user->ID );
		// Set the single author box to enabled when no author meta has been set.
		if ( '' === $single_box ) {
			$single_box = 1;
		}
		require_once flagship_library()->dir . 'templates/admin/settings-author-box.php';
	}

	/**
	 * Update author box user meta when user edit page is saved.
	 *
	 * @since  1.4.0
	 * @access public
	 * @param  $user_id integer The current user ID
	 * @return void
	 */
	public function meta_save( $user_id ) {
		if ( ! current_user_can( 'edit_users', $user_id ) ) {
			return;
		}

		$defaults = array(
			'flagship_author_box_single'  => 0,
			'flagship_author_box_archive' => 0,
		);

		if ( ! isset( $_POST['flagbox'] ) || ! is_array( $_POST['flagbox'] ) ) {
			foreach ( $defaults as $key => $value ) {
				update_user_meta( $user_id, $key, $value );
			}
			return;
		}

		$meta = wp_parse_args( $_POST['flagbox'], $defaults );

		foreach ( $meta as $key => $value ) {
			update_user_meta( $user_id, sanitize_key( $key ), absint( $value ) );
		}
	}

}
