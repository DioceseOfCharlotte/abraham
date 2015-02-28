<?php

add_action( 'init', 'abraham_add_shortcodes' );
add_action( 'init', 'abraham_add_shortcake' );

function abraham_add_shortcodes() {

add_shortcode( 'panel',	'abraham_panel_shortcode' );
add_shortcode( 'pullquote',	'abraham_pullquote_shortcode' );
add_shortcode( 'buttons',	'abraham_buttons_shortcode' );

}

/**
 * PANEL
 */
function abraham_panel_shortcode( $attr ) {

	extract( shortcode_atts(
		array(
			'heading' => '',
			'message' => '',
			'type' => ''
		), $attr )
	);

	ob_start();

	$return = '<div class="panel panel--' .$type. '">';
	if (!empty($type)) $return .= '<div class="panel__icon"><span></span></div>';
	$return .= '<div class="panel__body">';
	if (!empty($heading)) $return .= '<h4>'.$heading.'</h4>';
	$return .= '<p>'.$message.'</p></div></div>';
	return $return;

	return ob_get_clean();
}




/**
 * QUOTE
 */
function abraham_pullquote_shortcode( $attr ) {

	extract( shortcode_atts(
		array(
			'quote' => '',
			'source' => ''
		), $attr )
	);

	ob_start();

	$return = '<blockquote class="pullquote">' .$quote. '<br/>';
	$return .= '<cite>'.$source.'</cite></blockquote>';
	return $return;

	return ob_get_clean();
}




/**
 * BUTTONS
 */
function abraham_buttons_shortcode( $attr ) {

	extract( shortcode_atts(
		array(
			'type' => '',
			'link' => '',
			'label' => ''
		), $attr )
	);

	ob_start();

	$return = '<a href="' .$link. '" class="button button--'.$type.'"> ';
	$return .= $label.'</a>';
	return $return;

	return ob_get_clean();
}







/**
 * SHORTCAKE 
 * https://github.com/fusioneng/Shortcake
 */
function abraham_add_shortcake() {

	/**
	 * PANEL
	 */
	shortcode_ui_register_for_shortcode(
		'panel',
		array(

			'label' => 'Panel',

			'listItemImage' => 'dashicons-info',

			// Attribute model expects 'attr', 'type' and 'label'
			// Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
			'attrs' => array(
				array(
					'label' => 'Panel Type',
					'attr'  => 'type',
					'type'  => 'select',
                    'options' => array(
                    	''		=> __( 'Highlight', 'abraham' ),
						'info'		=> __( 'Information', 'abraham' ),
						'warning'		=> __( 'Warning', 'abraham' ),
						'important'	=> __( 'Important', 'abraham' ),
					),
				),
				array(
					'label' => 'Heading',
					'attr'  => 'heading',
					'type'  => 'text',
					'description' => 'Optional',
				),
				array(
					'label' => 'Content',
					'attr'  => 'message',
					'type'  => 'textarea',
				),
			),
		)
	);




	/**
	 * QUOTE
	 */
	shortcode_ui_register_for_shortcode(
		'pullquote',
		array(

			'label' => 'Pullquote',

			'listItemImage' => 'dashicons-editor-quote',

			'attrs' => array(
				array(
					'label' => 'Quote',
					'attr'  => 'quote',
					'type'  => 'textarea',
				),
				array(
					'label' => 'Cite',
					'attr'  => 'source',
					'type'  => 'text',
				),
			),
		)
	);




	/**
	 * BUTTONS
	 */
    shortcode_ui_register_for_shortcode(
        'buttons',
        array(

            'label' => 'Button',

            'listItemImage' => 'dashicons-share-alt2',

            'attrs' => array(
            	array(
                    'label' => 'Button Type',
                    'attr'  => 'type',
                    'type'  => 'select',
                    'options' => array(
                    	'btn'		=> __( 'General', 'abraham' ),
						'info'		=> __( 'Information', 'abraham' ),
						'form'		=> __( 'Form', 'abraham' ),
						'donate'	=> __( 'Donate', 'abraham' ),
						'link-ext'	=> __( 'External Link', 'abraham' ),
					),
                ),
                array(
                    'label' => 'Label',
                    'attr'  => 'label',
                    'type'  => 'text',
                ),
                array(
                    'label' => 'Link',
                    'attr'  => 'link',
                    'type'  => 'url',
                ),
            ),
        )
    );


}