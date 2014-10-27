<?php
/**
 * Diocese Core - A WordPress theme development framework.
 *
 * @package   DioceseCore
 * @version   0.1.0
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright Copyright (c) 2008 - 2014, Diocese of Charlotte
 * @link      http://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( !class_exists( 'Diocese' ) ) {

	class Diocese {

		/**
		 * Constructor method for the Diocese class.  This method adds other methods of the class to
		 * specific hooks within WordPress.  It controls the load order of the required files for running
		 * the framework.
		 *
		 * @since  0.1.0
		 * @access public
		 * @return void
		 */
		function __construct() {
			global $diocese;

			/* Set up an empty class for the global $diocese object. */
			$diocese = new stdClass;

			/* Define framework, parent theme, and child theme constants. */
			add_action( 'after_setup_theme', array( $this, 'constants' ), 1 );

			/* Load the framework extensions. */
			add_action( 'after_setup_theme', array( $this, 'includes' ), 12 );

			/* Load the framework extensions. */
			add_action( 'after_setup_theme', array( $this, 'extensions' ), 14 );

			/* Load admin files. */
			add_action( 'wp_loaded', array( $this, 'admin' ) );


}

		function constants() {

			/* Sets the framework version number. */
			define( 'DIOCESE_VERSION', '2.0.2' );

			/* Sets the path to the parent theme directory. */
			define( 'ABRAHAM_DIR', get_template_directory() );

			/* Sets the path to the parent theme directory URI. */
			define( 'ABRAHAM_URI', get_template_directory_uri() );

			/* Sets the path to the child theme directory. */
			define( 'ABRAHAM_CHILD_DIR', get_stylesheet_directory() );

			/* Sets the path to the child theme directory URI. */
			define( 'ABRAHAM_CHILD_URI', get_stylesheet_directory_uri() );

			/* Sets the path to the core framework directory. */
			if ( !defined( 'DIOCESE_DIR' ) )
				define( 'DIOCESE_DIR', trailingslashit( ABRAHAM_DIR ) . basename( dirname( __FILE__ ) ) );

			/* Sets the path to the core framework directory URI. */
			if ( !defined( 'DIOCESE_URI' ) )
				define( 'DIOCESE_URI', trailingslashit( ABRAHAM_URI ) . basename( dirname( __FILE__ ) ) );

			/* Sets the path to the core framework admin directory. */
			define( 'DIOCESE_ADMIN', trailingslashit( DIOCESE_DIR ) . 'admin' );

			/* Sets the path to the core framework extensions directory. */
			define( 'DIOCESE_EXTENSIONS', trailingslashit( DIOCESE_DIR ) . 'extensions' );

			/* Sets the path to the core framework includes directory. */
			define( 'DIOCESE_INCLUDES', trailingslashit( DIOCESE_DIR ) . 'includes' );

			/* Sets the path to the core framework includes directory. */
			define( 'DIOCESE_POSTS', trailingslashit( DIOCESE_INCLUDES ) . 'post-types' );

			/* Sets the path to the core framework includes directory. */
			define( 'DIOCESE_TAXONOMIES', trailingslashit( DIOCESE_INCLUDES ) . 'taxonomies' );

			/* Sets the path to the core framework includes directory. */
			define( 'DIOCESE_META', trailingslashit( DIOCESE_INCLUDES ) . 'meta' );

			/* Sets the path to the core framework includes directory. */
			define( 'DIOCESE_CONNECTIONS', trailingslashit( DIOCESE_INCLUDES ) . 'connections' );

			/* Sets the path to the core framework CSS directory URI. */
			define( 'DOC_CSS', trailingslashit( DIOCESE_URI ) . 'css' );

			/* Sets the path to the core framework CSS directory URI. */
			define( 'DOC_JS', trailingslashit( DIOCESE_URI ) . 'js' );
}

		/**
		 * Loads the framework files supported by themes and template-related functions/classes.  Functionality
		 * in these files should not be expected within the theme setup function.
		 *
		 * @since  0.1.0
		 * @access public
		 * @return void
		 */
		function includes() {

			if ( current_theme_supports( 'diocese-employees' ) && current_theme_supports( 'diocese-departments' ) ) {
				require_once( trailingslashit( DIOCESE_CONNECTIONS ) . 'dept-to-staff.php' );
			}

			if ( current_theme_supports( 'diocese-departments' ) && current_theme_supports( 'diocese-documents' ) ) {
				require_once( trailingslashit( DIOCESE_CONNECTIONS ) . 'dept-to-docs.php' );
			}

						/* Load the post-types if supported. */
			require_if_theme_supports( 'diocese-employees', trailingslashit( DIOCESE_POSTS ) . 'employees.php' );

			require_if_theme_supports( 'diocese-employees', trailingslashit( DIOCESE_META ) . 'employee-meta.php' );

			/* Load the post-types if supported. */
			require_if_theme_supports( 'diocese-documents', trailingslashit( DIOCESE_POSTS ) . 'documents.php' );
			require_if_theme_supports( 'diocese-documents', trailingslashit( DIOCESE_META ) . 'document-meta.php' );

			/* Load the post-types if supported. */
			require_if_theme_supports( 'diocese-departments', trailingslashit( DIOCESE_POSTS ) . 'departments.php' );
			require_if_theme_supports( 'diocese-departments', trailingslashit( DIOCESE_META ) . 'department-meta.php' );
		}

		function extensions() {

			// require_once( trailingslashit( DIOCESE_EXTENSIONS ) . 'p2p/posts-to-posts.php' );
			require_once( trailingslashit( DIOCESE_EXTENSIONS ) . 'cmb/init.php' );
			require_once( trailingslashit( DIOCESE_DIR ) . 'core.php' );

		}


		function admin() {

			/* Check if in the WordPress admin. */
			if ( is_admin() ) {

				/* Load the main admin file. */
				require_once( trailingslashit( DIOCESE_ADMIN ) . 'admin.php' );

			}
		}

	}

}

