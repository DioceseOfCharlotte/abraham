<?php

/**
 * Modifications to TinyMCE, the default WordPress editor.
 *
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 *
 * @link        https://flagshipwp.com/
 * @since       1.4.0
 */
add_filter('mce_buttons', 'abraham_add_styleselect', 99);
/**
 * Add styleselect button to the end of the first row of TinyMCE buttons.
 *
 * @since  1.4.0
 *
 * @param  $buttons array existing TinyMCE buttons
 *
 * @return $buttons array modified TinyMCE buttons
 */
function abraham_add_styleselect($buttons) {
	// Get rid of styleselect if it's been added somewhere else.
	if (in_array('styleselect', $buttons)) {
		unset($buttons['styleselect']);
	}
	array_push($buttons, 'styleselect');

	return $buttons;
}

add_filter('mce_buttons_2', 'abraham_disable_styleselect', 99);
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
function abraham_disable_styleselect($buttons) {
	if (in_array('styleselect', $buttons)) {
		unset($buttons['styleselect']);
	}

	return $buttons;
}

add_filter('tiny_mce_before_init', 'abraham_tiny_mce_formats', 99);
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
function abraham_tiny_mce_formats($args) {
	$abraham_formats = apply_filters('abraham_tiny_mce_formats',
		array(
			array(
				'title'    => __('DropCap', 'abraham'),
				'selector' => 'p',
				'classes'  => 'u-dropcap',
				'wrapper'  => true,
			),
			array(
				'title'   => __('Pull Quote Left', 'abraham'),
				'block'   => 'blockquote',
				'classes' => 'pullquote alignleft',
				'wrapper' => true,
			),
			array(
				'title'   => __('Pull Quote Right', 'abraham'),
				'block'   => 'blockquote',
				'classes' => 'pullquote alignright',
				'wrapper' => true,
			),
			array(
				'title'    => __('Intro Paragraph', 'abraham'),
				'selector' => 'p',
				'classes'  => 'intro-paragraph',
				'wrapper'  => true,
			),
			array(
				'title'   => __('Feature Box', 'abraham'),
				'block'   => 'div',
				'classes' => 'u-p2 u-shadow--3dp',
				'wrapper' => true,
				'exact'   => true,
			),
			array(
				'title'  => __('Code Block', 'abraham'),
				'format' => 'pre',
			),
			array(
				'title' => __('Buttons', 'abraham'),
				'items' => array(
					array(
						'title'    => __('Standard', 'abraham'),
						'selector' => 'a',
						'classes'  => 'btn',
						'exact'    => true,
					),
					array(
						'title'    => __('Primary Button', 'abraham'),
						'selector' => 'a',
						'classes'  => 'btn u-bg-1',
						'exact'    => true,
					),
					array(
						'title'    => __('Hollow Button', 'abraham'),
						'selector' => 'a',
						'classes'  => 'btn btn-hollow',
						'exact'    => true,
					),
				),
			),
		)
	);
	// Merge with any existing formats which have been added by plugins.
	if (!empty($args['style_formats'])) {
		$existing_formats = json_decode($args['style_formats']);
		$abraham_formats  = array_merge($abraham_formats, $existing_formats);
	}

	$args['style_formats'] = json_encode($abraham_formats);

	return $args;
}
