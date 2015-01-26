<?php
	/**
	 * https://github.com/cferdinandi/google-analytics/
	 * Fields
	 */
	function googanalytics_settings_field_google_analytics_id() {
		$options = googanalytics_get_theme_options();
		?>
		<input type="text" name="googanalytics_theme_options[google_analytics_id]" id="google-analytics-id" value="<?php echo esc_attr( $options['google_analytics_id'] ); ?>" /><br />
		<label class="description" for="google-analytics-id"><?php _e( 'Your Google Analytics ID in this format: <code>UA-XXXXX-X</code>', 'googanalytics' ); ?></label>
		<?php
	}
	function googanalytics_settings_field_ignore_admin() {
		$options = googanalytics_get_theme_options();
		?>
		<label for="ignore-admin">
			<input type="checkbox" name="googanalytics_theme_options[ignore_admin]" id="ignore-admin" <?php checked( 'on', $options['ignore_admin'] ); ?> />
			<?php _e( 'Don\'t capture analytics for site administrators and editors.', 'googanalytics' ); ?>
		</label>
		<?php
	}
	/**
	 * Menu
	 */
	// Register the theme options page and its fields
	function googanalytics_theme_options_init() {
		register_setting(
			'googanalytics_options', // Options group, see settings_fields() call in googanalytics_theme_options_render_page()
			'googanalytics_theme_options', // Database option, see googanalytics_get_theme_options()
			'googanalytics_theme_options_validate' // The sanitization callback, see googanalytics_theme_options_validate()
		);
		// Register our settings field group
		add_settings_section(
			'general', // Unique identifier for the settings section
			'', // Section title (we don't want one)
			'__return_false', // Section callback (we don't want anything)
			'googanalytics_theme_options' // Menu slug, used to uniquely identify the page; see googanalytics_theme_options_add_page()
		);
		// Register our individual settings fields
		// add_settings_field( $id, $title, $callback, $page, $section );
		// $id - Unique identifier for the field.
		// $title - Setting field title.
		// $callback - Function that creates the field (from the Theme Option Fields section).
		// $page - The menu page on which to display this field.
		// $section - The section of the settings page in which to show the field.
		add_settings_field( 'google_analytics_id', __( 'Google Analytics ID', 'googanalytics' ), 'googanalytics_settings_field_google_analytics_id', 'googanalytics_theme_options', 'general' );
		add_settings_field( 'ignore_admin', __( 'No Admin Analytics', 'googanalytics' ), 'googanalytics_settings_field_ignore_admin', 'googanalytics_theme_options', 'general' );
	}
	add_action( 'admin_init', 'googanalytics_theme_options_init' );
	// Create theme options menu
	// The content that's rendered on the menu page.
	function googanalytics_theme_options_render_page() {
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e( 'Google Analytics', 'googanalytics' ); ?></h2>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'googanalytics_options' );
					do_settings_sections( 'googanalytics_theme_options' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}
	// Add the theme options page to the admin menu
	function googanalytics_theme_options_add_page() {
		$theme_page = add_submenu_page(
			'options-general.php', // parent slug
			'Google Analytics', // Label in menu
			'Google Analytics', // Label in menu
			'edit_theme_options', // Capability required
			'googanalytics_theme_options', // Menu slug, used to uniquely identify the page
			'googanalytics_theme_options_render_page' // Function that renders the options page
		);
	}
	add_action( 'admin_menu', 'googanalytics_theme_options_add_page' );
	// Restrict access to the theme options page to admins
	function googanalytics_option_page_capability( $capability ) {
		return 'edit_theme_options';
	}
	add_filter( 'option_page_capability_googanalytics_options', 'googanalytics_option_page_capability' );
	/**
	 * Process Options
	 */
	// Get the current options from the database.
	// If none are specified, use these defaults.
	function googanalytics_get_theme_options() {
		$saved = (array) get_option( 'googanalytics_theme_options' );
		$defaults = array(
			'google_analytics_id' => '',
			'ignore_admin' => 'off',
		);
		$defaults = apply_filters( 'googanalytics_default_theme_options', $defaults );
		$options = wp_parse_args( $saved, $defaults );
		$options = array_intersect_key( $options, $defaults );
		return $options;
	}
	// Sanitize and validate updated theme options
	function googanalytics_theme_options_validate( $input ) {
		$output = array();
		if ( isset( $input['google_analytics_id'] ) && ! empty( $input['google_analytics_id'] ) )
			$output['google_analytics_id'] = wp_filter_nohtml_kses( $input['google_analytics_id'] );
		if ( isset( $input['ignore_admin'] ) )
			$output['ignore_admin'] = 'on';
		return apply_filters( 'googanalytics_theme_options_validate', $output, $input );
	}
	/**
	 * Get Options
	 */
	function googanalytics_get_google_analytics_id() {
		$options = googanalytics_get_theme_options();
		$setting = $options['google_analytics_id'];
		return $setting;
	}
	function googanalytics_get_ignore_admin() {
		$options = googanalytics_get_theme_options();
		$setting = $options['ignore_admin'];
		if ( $setting == 'on' && current_user_can( 'edit_others_posts' ) ) {
			return true;
		} else {
			return false;
		}
	}





	// Get settings
	require_once( dirname( __FILE__) . '/html5bp-google-analytics-options.php' );
	function googanalytics_add_google_analytics( $query ) {
		$google_analytics_id = googanalytics_get_google_analytics_id();
		if ( $google_analytics_id != '' && !googanalytics_get_ignore_admin() ) {
			$script = "
				<script>
					(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
					function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
					e=o.createElement(i);r=o.getElementsByTagName(i)[0];
					e.src='//www.google-analytics.com/analytics.js';
					r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
					ga('create','" . $google_analytics_id . "');ga('send','pageview');
				</script>";
			echo $script;
		}
	}
	add_action('wp_footer', 'googanalytics_add_google_analytics', 30);
