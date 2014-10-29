<?php
/**
 * Handles custom post meta boxes for the 'directory_item' post type.
 *
 * @package    Directory
 * @subpackage Admin
 * @since      1.0.0
 * @author     Marty Helmick <justin@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

final class DOC_Directory_Settings {

	/**
	 * Holds the instances of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance;

	/**
	 * Settings page name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $settings_page = '';

	/**
	 * Holds an array the plugin settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $settings = array();

	/**
	 * Sets up the needed actions for adding and saving the meta boxes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Sets up custom admin menus.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_menu() {

		$this->settings_page = add_submenu_page( 
			'edit.php?post_type=directory_item',
			__( 'Directory Settings', 'directory' ),
			__( 'Settings',            'directory' ),
			apply_filters( 'directory_settings_capability', 'manage_options' ),
			'directory-settings',
			array( $this, 'settings_page' )
		);

		if ( !empty( $this->settings_page ) ) {

			/* Register the plugin settings. */
			add_action( 'admin_init', array( $this, 'register_settings' ) );

			/* Add media for the settings page. */
		//	add_action( 'admin_enqueue_scripts',             array( $this, 'enqueue_scripts' ) );
		//	add_action( "admin_head-{$this->settings_page}", array( $this, 'print_scripts'   ) );

			/* Load the meta boxes. */
		//	add_action( 'add_meta_boxes_directory', array( $this, 'add_meta_boxes' ) );
		}
	}

	/**
	 * Registers the plugin settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function register_settings() {

		$this->settings = get_option( 'directory_settings', doc_get_default_settings() );

		register_setting( 'directory_settings', 'directory_settings', array( $this, 'validate_settings' ) );

		add_settings_section( 
			'doc_section_menu', 
			__( 'Menu Settings', 'directory' ), 
			array( $this, 'section_menu' ),
			$this->settings_page
		);

		add_settings_field(
			'doc_field_menu_title',
			__( 'Menu Archive Title', 'directory' ),
			array( $this, 'field_menu_title' ),
			$this->settings_page,
			'doc_section_menu'
		);

		add_settings_field(
			'doc_field_menu_description',
			__( 'Menu Archive Description', 'directory' ),
			array( $this, 'field_menu_description' ),
			$this->settings_page,
			'doc_section_menu'
		);
	}

	/**
	 * Validates the plugin settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function validate_settings( $settings ) {

		$settings['directory_item_archive_title'] = strip_tags( $settings['directory_item_archive_title'] );

		/* Kill evil scripts. */
		if ( !current_user_can( 'unfiltered_html' ) )
			$settings['directory_item_description'] = stripslashes( wp_filter_post_kses( addslashes( $settings['directory_item_description'] ) ) );

		/* Return the validated/sanitized settings. */
		return $settings;
	}

	/**
	 * Displays the menu settings section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function section_menu() { ?>

		<p class="description">
			<?php printf( __( "Your directory's menu is located at %s.", 'directory' ), '<a href="' . get_post_type_archive_link( 'directory_item' ) . '"><code>' . get_post_type_archive_link( 'directory_item' ) . '</code></a>' ); ?>
		</p>
	<?php }

	/**
	 * Displays the menu title field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function field_menu_title() { ?>

		<p>
			<input type="text" class="regular-text" name="directory_settings[directory_item_archive_title]" id="directory_settings-directory_item_archive_title" value="<?php echo esc_attr( $this->settings['directory_item_archive_title'] ); ?>" />
		</p>
	<?php }

	/**
	 * Displays the menu description field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function field_menu_description() { ?>

		<p>
			<textarea class="large-text" name="directory_settings[directory_item_description]" id="directory_settings-directory_item_description" rows="4"><?php echo esc_textarea( $this->settings['directory_item_description'] ); ?></textarea>
			<span class="description"><?php _e( "Custom description for your directory's menu. You may use <abbr title='Hypertext Markup Language'>HTML</abbr>. Your theme may or may not display this description.", 'directory' ); ?></span>
		</p>
	<?php }

	/**
	 * Renders the settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings_page() { ?>

		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e( 'Directory Settings', 'directory' ); ?></h2>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php settings_fields( 'directory_settings' ); ?>
				<?php do_settings_sections( $this->settings_page ); ?>
				<?php submit_button( esc_attr__( 'Update Settings', 'directory' ), 'primary' ); ?>
			</form>

		</div><!-- wrap -->
	<?php }

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

DOC_Directory_Settings::get_instance();
