<?php
/**
 * SHORTCAKE
 * https://github.com/fusioneng/Shortcake.
 */
add_action('init', 'meh_add_shortcake');

function meh_add_shortcake() {

    /* Make sure the Shortcake plugin is active. */
if (!function_exists('shortcode_ui_register_for_shortcode')) {
    return;
}
    $abraham_dir = trailingslashit(get_template_directory_uri());

    /*
     * TILES
     */
    shortcode_ui_register_for_shortcode(
        'meh_tile',
        array(
            'label'         => 'Tile',
            'listItemImage' => 'dashicons-screenoptions',
            'attrs' => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'options'     => array(
        					                ''      => esc_html__( 'None', 'abraham' ),
        	            'u-bg-white u-text-black'   => esc_html__( 'White', 'abraham' ),
        	            'u-bg-1 u-text-white'       => esc_html__( 'Primary color', 'abraham' ),
        	            'u-bg-2 u-text-black'       => esc_html__( 'Secondary color', 'abraham' ),
        	            'u-bg-1-glass u-text-white'       => esc_html__( 'Glass 1', 'abraham' ),
        	            'u-bg-2-glass u-text-black'       => esc_html__( 'Glass 2', 'abraham' ),
        	            'u-bg-1-glass-light u-text-white' => esc_html__( 'Glass 1 light', 'abraham' ),
        	            'u-bg-2-glass-light u-text-black' => esc_html__( 'Glass 2 light', 'abraham' ),
        	            'u-bg-1-glass-dark u-text-white'  => esc_html__( 'Glass 1 dark', 'abraham' ),
        	            'u-bg-2-glass-dark u-text-black'  => esc_html__( 'Glass 2 dark', 'abraham' ),
        	            'u-bg-frost-4 u-text-black'       => esc_html__( 'Frosted', 'abraham' ),
        	            'u-bg-tint-4 u-text-white'        => esc_html__( 'Tinted', 'abraham' ),
        	            'u-bg-silver u-text-black'        => esc_html__( 'Neutral Gray', 'abraham' ),
        			),
        		),
        		array(
        			'label'  => esc_html__( 'Intro Text', 'abraham' ),
        			'attr'   => 'row_intro',
        			'type'   => 'text',
        			'encode' => true,
        			'meta'   => array(
        				'placeholder' => esc_html__( 'Introduce your row with a heading!', 'abraham' ),
        				'data-test'   => 1,
        			),
        		),

                array(
                    'label'    => 'Select Page',
                    'attr'     => 'page',
                    'type'     => 'post_select',
                    'query'    => array('post_type' => array( 'page', 'cpt_archive', 'department' )),
                    'multiple' => true,
               ),
           ),
       )
   );

   /*
    * CARDS
    */
   shortcode_ui_register_for_shortcode(
       'meh_cards',
       array(
           'label'         => 'Cards',
           'listItemImage' => 'dashicons-schedule',
           'attrs' => array(

               array(
                   'label'   => 'Row Color',
                   'attr'    => 'row_color',
                   'type'    => 'select',
                   'options'     => array(
       					                ''      => esc_html__( 'None', 'abraham' ),
       	            'u-bg-white u-text-black'   => esc_html__( 'White', 'abraham' ),
       	            'u-bg-1 u-text-white'       => esc_html__( 'Primary color', 'abraham' ),
       	            'u-bg-2 u-text-black'       => esc_html__( 'Secondary color', 'abraham' ),
       	            'u-bg-1-glass u-text-white'       => esc_html__( 'Glass 1', 'abraham' ),
       	            'u-bg-2-glass u-text-black'       => esc_html__( 'Glass 2', 'abraham' ),
       	            'u-bg-1-glass-light u-text-white' => esc_html__( 'Glass 1 light', 'abraham' ),
       	            'u-bg-2-glass-light u-text-black' => esc_html__( 'Glass 2 light', 'abraham' ),
       	            'u-bg-1-glass-dark u-text-white'  => esc_html__( 'Glass 1 dark', 'abraham' ),
       	            'u-bg-2-glass-dark u-text-black'  => esc_html__( 'Glass 2 dark', 'abraham' ),
       	            'u-bg-frost-4 u-text-black'       => esc_html__( 'Frosted', 'abraham' ),
       	            'u-bg-tint-4 u-text-white'        => esc_html__( 'Tinted', 'abraham' ),
       	            'u-bg-silver u-text-black'        => esc_html__( 'Neutral Gray', 'abraham' ),
       			),
       		),
       		array(
       			'label'  => esc_html__( 'Intro Text', 'abraham' ),
       			'attr'   => 'row_intro',
       			'type'   => 'text',
       			'encode' => true,
       			'meta'   => array(
       				'placeholder' => esc_html__( 'Introduce your row with a heading!', 'abraham' ),
       				'data-test'   => 1,
       			),
       		),

               array(
                   'label'   => 'Content to Show',
                   'attr'    => 'show_content',
                   'type'    => 'select',
                   'value'   => 'excerpt',
                   'options' => array(
                       'excerpt' => 'Excerpt',
                       'content' => 'Content',
                       'none'    => 'None',
                  ),
               ),

               array(
                   'label'   => 'Show Featured Image',
                   'attr'    => 'show_image',
                   'type'    => 'select',
                   'value'   => 'show_img',
                   'options' => array(
                       'show_img' => 'Show Image',
                       'hide_img' => 'Hide Image',
                  ),
              ),

               array(
                   'label'    => 'Select Page',
                   'attr'     => 'page',
                   'type'     => 'post_select',
                   'query'    => array('post_type' => array( 'page', 'cpt_archive', 'department' )),
                   'multiple' => true,
              ),
          ),
      )
  );




    /*
     * PANEL
     */
    shortcode_ui_register_for_shortcode(
        'meh_block',
        array(
            'label'         => 'Block',
            'listItemImage' => 'dashicons-align-center',
            'attrs' => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'options'     => array(
        					                ''      => esc_html__( 'None', 'abraham' ),
        	            'u-bg-white u-text-black'   => esc_html__( 'White', 'abraham' ),
        	            'u-bg-1 u-text-white'       => esc_html__( 'Primary color', 'abraham' ),
        	            'u-bg-2 u-text-black'       => esc_html__( 'Secondary color', 'abraham' ),
        	            'u-bg-1-glass u-text-white'       => esc_html__( 'Glass 1', 'abraham' ),
        	            'u-bg-2-glass u-text-black'       => esc_html__( 'Glass 2', 'abraham' ),
        	            'u-bg-1-glass-light u-text-white' => esc_html__( 'Glass 1 light', 'abraham' ),
        	            'u-bg-2-glass-light u-text-black' => esc_html__( 'Glass 2 light', 'abraham' ),
        	            'u-bg-1-glass-dark u-text-white'  => esc_html__( 'Glass 1 dark', 'abraham' ),
        	            'u-bg-2-glass-dark u-text-black'  => esc_html__( 'Glass 2 dark', 'abraham' ),
        	            'u-bg-frost-4 u-text-black'       => esc_html__( 'Frosted', 'abraham' ),
        	            'u-bg-tint-4 u-text-white'        => esc_html__( 'Tinted', 'abraham' ),
        	            'u-bg-silver u-text-black'        => esc_html__( 'Neutral Gray', 'abraham' ),
        			),
        		),
        		array(
        			'label'  => esc_html__( 'Intro Text', 'abraham' ),
        			'attr'   => 'row_intro',
        			'type'   => 'text',
        			'encode' => true,
        			'meta'   => array(
        				'placeholder' => esc_html__( 'Introduce your row with a heading!', 'abraham' ),
        				'data-test'   => 1,
        			),
        		),

                array(
                    'label'   => 'Content to Show',
                    'attr'    => 'show_content',
                    'type'    => 'select',
                    'value'   => 'excerpt',
                    'options' => array(
                        'excerpt' => 'Excerpt',
                        'content' => 'Content',
                        'none'    => 'None',
                   ),
                ),

                array(
                    'label'   => 'Show Featured Image',
                    'attr'    => 'show_image',
                    'type'    => 'select',
                    'value'   => 'show_img',
                    'options' => array(
                        'show_img' => 'Show Image',
                        'hide_img' => 'Hide Image',
                   ),
               ),

                array(
                    'label'    => 'Select Page',
                    'attr'     => 'page',
                    'type'     => 'post_select',
                    'query'    => array('post_type' => array( 'page', 'cpt_archive', 'department' )),
                    'multiple' => true,
               ),
           ),
       )
   );

    /*
     * Toggles
     */
    shortcode_ui_register_for_shortcode(
        'meh_toggles',
        array(
            'label'         => 'Toggles',
            'listItemImage' => 'dashicons-sort',
            'attrs'         => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'options'     => array(
        					                ''      => esc_html__( 'None', 'abraham' ),
        	            'u-bg-white u-text-black'   => esc_html__( 'White', 'abraham' ),
        	            'u-bg-1 u-text-white'       => esc_html__( 'Primary color', 'abraham' ),
        	            'u-bg-2 u-text-black'       => esc_html__( 'Secondary color', 'abraham' ),
        	            'u-bg-1-glass u-text-white'       => esc_html__( 'Glass 1', 'abraham' ),
        	            'u-bg-2-glass u-text-black'       => esc_html__( 'Glass 2', 'abraham' ),
        	            'u-bg-1-glass-light u-text-white' => esc_html__( 'Glass 1 light', 'abraham' ),
        	            'u-bg-2-glass-light u-text-black' => esc_html__( 'Glass 2 light', 'abraham' ),
        	            'u-bg-1-glass-dark u-text-white'  => esc_html__( 'Glass 1 dark', 'abraham' ),
        	            'u-bg-2-glass-dark u-text-black'  => esc_html__( 'Glass 2 dark', 'abraham' ),
        	            'u-bg-frost-4 u-text-black'       => esc_html__( 'Frosted', 'abraham' ),
        	            'u-bg-tint-4 u-text-white'        => esc_html__( 'Tinted', 'abraham' ),
        	            'u-bg-silver u-text-black'        => esc_html__( 'Neutral Gray', 'abraham' ),
        			),
        		),
        		array(
        			'label'  => esc_html__( 'Intro Text', 'abraham' ),
        			'attr'   => 'row_intro',
        			'type'   => 'text',
        			'encode' => true,
        			'meta'   => array(
        				'placeholder' => esc_html__( 'Introduce your row with a heading!', 'abraham' ),
        				'data-test'   => 1,
        			),
        		),

                array(
                    'label'   => 'Content to Show',
                    'attr'    => 'show_content',
                    'type'    => 'select',
                    'value'   => 'excerpt',
                    'options' => array(
                        'excerpt' => 'Excerpt',
                        'content' => 'Content',
                   ),
               ),

                array(
                    'label'    => 'Select Page',
                    'attr'     => 'page',
                    'type'     => 'post_select',
                    'query'    => array('post_type' => array( 'page', 'cpt_archive', 'department' )),
                    'multiple' => true,
               ),
           ),
       )
   );
}


/*
 * SLIDES
 */
shortcode_ui_register_for_shortcode(
    'meh_slides',
    array(
        'label'         => 'Slides',
        'listItemImage' => 'dashicons-editor-insertmore',
        'attrs' => array(

            array(
                'label'   => 'Row Color',
                'attr'    => 'row_color',
                'type'    => 'select',
                'options'     => array(
                                        ''      => esc_html__( 'None', 'abraham' ),
                    'u-bg-white u-text-black'   => esc_html__( 'White', 'abraham' ),
                    'u-bg-1 u-text-white'       => esc_html__( 'Primary color', 'abraham' ),
                    'u-bg-2 u-text-black'       => esc_html__( 'Secondary color', 'abraham' ),
                    'u-bg-1-glass u-text-white'       => esc_html__( 'Glass 1', 'abraham' ),
                    'u-bg-2-glass u-text-black'       => esc_html__( 'Glass 2', 'abraham' ),
                    'u-bg-1-glass-light u-text-white' => esc_html__( 'Glass 1 light', 'abraham' ),
                    'u-bg-2-glass-light u-text-black' => esc_html__( 'Glass 2 light', 'abraham' ),
                    'u-bg-1-glass-dark u-text-white'  => esc_html__( 'Glass 1 dark', 'abraham' ),
                    'u-bg-2-glass-dark u-text-black'  => esc_html__( 'Glass 2 dark', 'abraham' ),
                    'u-bg-frost-4 u-text-black'       => esc_html__( 'Frosted', 'abraham' ),
                    'u-bg-tint-4 u-text-white'        => esc_html__( 'Tinted', 'abraham' ),
                    'u-bg-silver u-text-black'        => esc_html__( 'Neutral Gray', 'abraham' ),
                ),
            ),
            array(
                'label'  => esc_html__( 'Intro Text', 'abraham' ),
                'attr'   => 'row_intro',
                'type'   => 'text',
                'encode' => true,
                'meta'   => array(
                    'placeholder' => esc_html__( 'Introduce your row with a heading!', 'abraham' ),
                    'data-test'   => 1,
                ),
            ),

            array(
                'label'    => 'Select Page',
                'attr'     => 'page',
                'type'     => 'post_select',
                'query'    => array('post_type' => array( 'page', 'department' )),
                'multiple' => true,
           ),
       ),
   )
);
