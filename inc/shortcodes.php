<?php

add_action( 'init', function() {

	/**
	 * Register your shortcode as you would normally.
	 * This is a simple example for a pullquote with a citation.
	 */
	add_shortcode( 'pullquote', function( $attr, $content = '' ) {

		$attr = wp_parse_args( $attr, array(
			'source' => ''
		) );

		ob_start();

		?>

		<blockquote class="pullquote">
			<?php echo esc_html( $content ); ?><br/>
			<cite><?php echo esc_html( $attr['source'] ); ?></cite>
		</blockquote>

		<?php

		return ob_get_clean();
	} );

	/**
	 * Register a UI for the Shortcode.
	 * Pass the shortcode tag (string)
	 * and an array or args.
	 */
	shortcode_ui_register_for_shortcode(
		'pullquote',
		array(

			// Display label. String. Required.
			'label' => 'Pullquote',

			// Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
			'listItemImage' => 'dashicons-editor-quote',

			// Available shortcode attributes and default values. Required. Array.
			// Attribute model expects 'attr', 'type' and 'label'
			// Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
			'attrs' => array(
				array(
					'label' => 'Quote',
					'attr'  => 'content',
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
     * Register your shortcode as you would normally.
     * This is a simple example for a pullquote with a citation.
     */
    add_shortcode( 'button', function( $attr, $content = '' ) {

        $attr = wp_parse_args( $attr, array(
            'source' => '',
            'type' => '',
        ) );

        ob_start();

        ?>
 
 		<a href="<?php echo esc_html( $attr['source'] ); ?>" class="button button--<?php echo esc_html( $attr['type'] ); ?>"> <?php echo esc_html( $content ); ?></a>
 
        <?php

        return ob_get_clean();
    } );

    /**
     * Register a UI for the Shortcode.
     * Pass the shortcode tag (string)
     * and an array or args.
     */
    shortcode_ui_register_for_shortcode(
        'button',
        array(

            // Display label. String. Required.
            'label' => 'Button',

            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
            'listItemImage' => 'dashicons-share-alt2',

            // Available shortcode attributes and default values. Required. Array.
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(
            	array(
                    'label' => 'Button Type',
                    'attr'  => 'type',
                    'type'  => 'select',
                    'options' => array(
                    	'btn'		=> __( 'General', 'abraham' ),
						'info'		=> __( 'Information', 'abraham' ),
						'form'		=> __( 'Form', 'abraham' ),
						'link-ext'	=> __( 'External Link', 'abraham' ),
					),
                ),
                array(
                    'label' => 'Label',
                    'attr'  => 'content',
                    'type'  => 'text',
                ),
                array(
                    'label' => 'Link',
                    'attr'  => 'source',
                    'type'  => 'url',
                ),
            ),
        )
    );



	/**
	 * Register your shortcode as you would normally.
	 * This is a simple example for a pullquote with a citation.
	 */
	add_shortcode( 'email', function( $attr, $content = '' ) {

		$attr = wp_parse_args( $attr, array(
			'source' => '',
			'subject' => '',
		) );

		ob_start();

		?>

		<a href="mailto:<?php echo esc_html( $attr['source'] ); ?>?subject=<?php echo esc_html( $attr['subject'] ); ?>"> <?php echo esc_html( $content ); ?></a><br>

		<?php

		return ob_get_clean();
	} );

	/**
	 * Register a UI for the Shortcode.
	 * Pass the shortcode tag (string)
	 * and an array or args.
	 */
	shortcode_ui_register_for_shortcode(
		'email',
		array(

			// Display label. String. Required.
			'label' => 'Email',

			// Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
			'listItemImage' => 'dashicons-email-alt',

			// Available shortcode attributes and default values. Required. Array.
			// Attribute model expects 'attr', 'type' and 'label'
			// Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
			'attrs' => array(
				array(
					'label' => 'Display Name',
					'attr'  => 'content',
					'type'  => 'text',
					'description' => 'You can display the person\'s name or the email address.'
				),
				array(
					'label' => 'Email Subject Line',
					'attr'  => 'subject',
					'type'  => 'text',
					'description' => 'The subject line when an email is composed from this link.'
				),
				array(
					'label' => 'Email Address',
					'attr'  => 'source',
					'type'  => 'email',
				),
			),
		)
	);

	add_shortcode( 'phone', function( $attr, $content = '' ) {

		$attr = wp_parse_args( $attr, array(
			'source' => ''
		) );

		ob_start();

		?>

		<a href="tel:<?php echo esc_html( $attr['source'] ); ?>-<?php echo esc_html( $content ); ?>"> (<?php echo esc_html( $attr['source'] ); ?>) <?php echo esc_html( $content ); ?></a><br>

		<?php

		return ob_get_clean();
	} );

	/**
	 * Register a UI for the Shortcode.
	 * Pass the shortcode tag (string)
	 * and an array or args.
	 */
	shortcode_ui_register_for_shortcode(
		'phone',
		array(

			// Display label. String. Required.
			'label' => 'Phone',

			// Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
			'listItemImage' => 'dashicons-phone',

			// Available shortcode attributes and default values. Required. Array.
			// Attribute model expects 'attr', 'type' and 'label'
			// Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
			'attrs' => array(
				array(
					'label' => 'Area Code',
					'attr'  => 'source',
					'type'  => 'text',
					'description' => '(3 digits) ex: 704',
				),
				array(
					'label' => 'Local',
					'attr'  => 'content',
					'type'  => 'text',
					'description' => '(7 digits) ex: 555-5555',
				),
			),
		)
	);



    /**
     * Register your shortcode as you would normally.
     * This is a simple example for a pullquote with a citation.
     */
    add_shortcode( 'address', function( $attr, $content = '' ) {

        $attr = wp_parse_args( $attr, array(
            'street' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
        ) );

        ob_start();

        ?>
 
		<address>
		    <?php echo esc_html( $content ); ?><br>
		    <?php echo esc_html( $attr['street'] ); ?><br>
		    <?php echo esc_html( $attr['city'] ); ?>, <?php echo esc_html( $attr['state'] ); ?> <?php echo esc_html( $attr['zip'] ); ?><br>
		</address>
 
        <?php

        return ob_get_clean();
    } );

    /**
     * Register a UI for the Shortcode.
     * Pass the shortcode tag (string)
     * and an array or args.
     */
    shortcode_ui_register_for_shortcode(
        'address',
        array(

            // Display label. String. Required.
            'label' => 'Address',

            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
            'listItemImage' => 'dashicons-location-alt',

            // Available shortcode attributes and default values. Required. Array.
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(
                array(
                    'label' => 'Name',
                    'attr'  => 'content',
                    'type'  => 'text',
                    'description'  => 'name or business name',
                ),
            	array(
                    'label' => 'Street',
                    'attr'  => 'street',
                    'type'  => 'text',
                ),
                array(
                    'label' => 'City',
                    'attr'  => 'city',
                    'type'  => 'text',
                ),
                array(
                    'label' => 'State',
                    'attr'  => 'state',
                    'type'  => 'text',
                ),
                array(
                    'label' => 'Zip',
                    'attr'  => 'zip',
                    'type'  => 'text',
                ),
            ),
        )
    );

	/**
	 * Register your shortcode as you would normally.
	 * This is a simple example for a pullquote with a citation.
	 */
	add_shortcode( 'attention', function( $attr, $content = '' ) {

		$attr = wp_parse_args( $attr, array(
			'type' => ''
		) );

		ob_start();

		?>

<div class="panel panel--<?php echo esc_html( $attr['type'] ); ?>">
  <p><?php echo esc_html( $content ); ?></p>
</div>

		<?php

		return ob_get_clean();
	} );

	/**
	 * Register a UI for the Shortcode.
	 * Pass the shortcode tag (string)
	 * and an array or args.
	 */
	shortcode_ui_register_for_shortcode(
		'attention',
		array(

			// Display label. String. Required.
			'label' => 'Attention Panel',

			// Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
			'listItemImage' => 'dashicons-info',

			// Available shortcode attributes and default values. Required. Array.
			// Attribute model expects 'attr', 'type' and 'label'
			// Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
			'attrs' => array(
				array(
					'label' => 'Panel Type',
					'attr'  => 'type',
					'type'  => 'select',
                    'options' => array(
                    	'panel'		=> __( 'Highlight', 'abraham' ),
						'info'		=> __( 'Information', 'abraham' ),
						'warning'		=> __( 'Warning', 'abraham' ),
						'important'	=> __( 'Important', 'abraham' ),
					),
				),
				array(
					'label' => 'Content',
					'attr'  => 'content',
					'type'  => 'textarea',
				),
			),
		)
	);

} );
