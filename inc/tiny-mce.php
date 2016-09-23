<?php
/**
 * Modifications to TinyMCE, the default WordPress editor.
 *
 * @package Abraham
 */

add_filter( 'mce_buttons', 'abraham_add_styleselect', 99 );
add_filter( 'mce_buttons_2', 'abraham_disable_styleselect', 99 );
add_filter( 'tiny_mce_before_init', 'abraham_tiny_mce_formats', 99 );

/**
 * Add styleselect button to the end of the first row of TinyMCE buttons.
 *
 * @since  1.4.0
 *
 * @param  $buttons array existing TinyMCE buttons
 *
 * @return $buttons array modified TinyMCE buttons
 */
function abraham_add_styleselect( $buttons ) {
	// Get rid of styleselect if it's been added somewhere else.
	if ( in_array( 'styleselect', $buttons ) ) {
		unset( $buttons['styleselect'] );
	}
	array_push( $buttons, 'styleselect' );

	return $buttons;
}

/**
 * Remove styleselect button if it's been added to the second row of TinyMCE
 * buttons.
 *
 * @since  1.4.0
 *
 * @param  $buttons array existing TinyMCE buttons
 *
 * @return $buttons array modified TinyMCE buttons
 */
function abraham_disable_styleselect( $buttons ) {
	if ( in_array( 'styleselect', $buttons ) ) {
		unset( $buttons['styleselect'] );
	}

	return $buttons;
}

/**
 * Add our custom Flagship styles to the styleselect dropdown button.
 *
 * @since  1.4.0
 *
 * @param  $args array existing TinyMCE arguments
 *
 * @return $args array modified TinyMCE arguments
 *
 * @see    http://wordpress.stackexchange.com/a/128950/9844
 */
function abraham_tiny_mce_formats( $initArray ) {
	$style_formats = array(
		// Each array child is a format with its own settings
		array(
			'title'    => __( 'Intro Paragraph', 'abraham' ),
			'selector' => 'p',
			'classes'  => 'intro-paragraph u-lead',
			'wrapper'  => true,
		),
		array(
			'title'    => __( 'Dropcap', 'abraham' ),
			'selector' => 'p',
			'classes'  => 'u-dropcap',
			'wrapper'  => true,
		),
		array(
			'title' => __( 'Button', 'abraham' ),
			'items' => array(
				array(
					'title'    => __( 'Standard', 'abraham' ),
					'selector' => 'a',
					'classes'  => 'btn u-bg-1',
					'exact'    => true,
				),
				array(
					'title'    => __( 'Accent', 'abraham' ),
					'selector' => 'a',
					'classes'  => 'btn u-bg-2',
					'exact'    => true,
				),
				array(
					'title'    => __( 'Hollow', 'abraham' ),
					'selector' => 'a',
					'classes'  => 'btn btn-hollow',
					'exact'    => true,
				),
				array(
					'title'    => __( 'Discreet', 'abraham' ),
					'selector' => 'a',
					'classes'  => 'btn',
					'exact'    => true,
				),
			),
		),
		array(
			'title'   => __( 'List Group', 'abraham' ),
			'items' => array(
				array(
					'title'    => __( 'No Bullets', 'abraham' ),
					'selector' => 'ul',
					'classes'  => 'u-list-reset',
					'wrapper'  => true,
				),
				array(
					'title'    => __( 'Bordered', 'abraham' ),
					'selector' => 'ul',
					'classes'  => 'o-list-group',
					'wrapper'  => true,
				),
				array(
					'title'    => __( 'Bordered Links', 'abraham' ),
					'selector' => 'ul',
					'classes'  => 'o-list-group-links',
					'wrapper'  => true,
				),
				array(
					'title'    => __( 'Ordered Steps', 'abraham' ),
					'selector' => 'ol',
					'classes'  => 'o-list-steps',
					'wrapper'  => true,
				),
				array(
					'title'    => __( 'Heart', 'abraham' ),
					'selector' => 'ul',
					'classes'  => 'o-list-group bullet-heart',
					'wrapper'  => true,
				),
				array(
					'title'    => __( 'Cross', 'abraham' ),
					'selector' => 'ul',
					'classes'  => 'o-list-group bullet-cross',
					'wrapper'  => true,
				),
			),
		),
		array(
			'title'   => __( 'Callout Box', 'abraham' ),
			'items' => array(
				array(
					'title'    => __( 'Primary color', 'abraham' ),
					'block'   => 'div',
					'classes' => 'u-p3 u-pt1 u-bg-1 u-text-wrap u-br u-mb3 u-shadow1',
					'wrapper' => true,
					//'exact'   => true,
				),
				array(
					'title'    => __( 'Secondary color', 'abraham' ),
					'block'   => 'div',
					'classes' => 'u-p3 u-pt1 u-bg-2 u-text-wrap u-br u-mb3 u-shadow1',
					'wrapper' => true,
					//'exact'   => true,
				),
				array(
					'title'    => __( 'Grey', 'abraham' ),
					'block'   => 'div',
					'classes' => 'u-p3 u-pt1 u-bg-silver u-text-wrap u-br u-mb3 u-shadow1',
					'wrapper' => true,
					//'exact'   => true,
				),
			),
		),

		array(
			'title'   => __( 'Alert', 'abraham' ),
			'items' => array(
				array(
					'title'    => __( 'Information', 'abraham' ),
					'block'   => 'div',
					'classes' => 'o-alert icon-info u-p1 u-bg-info u-currentcolor_a u-text-wrap u-br u-mb3 u-border',
					'wrapper' => true,
					//'exact'   => true,
				),
				array(
					'title'    => __( 'Success', 'abraham' ),
					'block'   => 'div',
					'classes' => 'o-alert icon-success u-p1 u-bg-success u-currentcolor_a u-text-wrap u-br u-mb3 u-border',
					'wrapper' => true,
					//'exact'   => true,
				),
				array(
					'title'    => __( 'Warning', 'abraham' ),
					'block'   => 'div',
					'classes' => 'o-alert icon-warning u-p1 u-bg-warning u-currentcolor_a u-text-wrap u-br u-mb3 u-border',
					'wrapper' => true,
					//'exact'   => true,
				),
			),
		),

		array(
			'title'   => __( 'Flex Grid', 'abraham' ),
			'block'   => 'div',
			'classes' => 'o-grid u-flex-ja',
			'wrapper' => true,
			//'exact'   => true,
		),
	);

	// Merge with any existing formats which have been added by plugins.
	if ( ! empty( $initArray['style_formats'] ) ) {
		$existing_formats = json_decode( $initArray['style_formats'] );
		$style_formats  = array_merge( $style_formats, $existing_formats );
	}

	$initArray[ 'style_formats' ] = json_encode( $style_formats );
	$initArray[ 'block_formats' ] = 'Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Paragraph=p';
	// $initArray[ 'toolbar1' ] = 'bold italic | formatselect styleselect | alignleft aligncenter alignright | bullist numlist indent outdent | blockquote hr table | link unlink | undo redo | wp_more | wp_help'; // you can easily add/remove buttons by editing this row, as you feel appropriate
	//$initArray[ 'toolbar2' ] = '';
	// $initArray[ 'paste_text_use_dialog' ] = 'false';
	// $initArray[ 'paste_auto_cleanup_on_paste' ] = 'true';
	// $initArray[ 'paste_remove_styles' ] = 'true';
	// $initArray[ 'paste_as_text' ] = 'true';
	// $initArray[ 'paste_text_sticky' ] = 'true';
	return $initArray;
}
