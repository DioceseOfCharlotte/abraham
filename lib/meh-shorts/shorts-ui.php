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
     * PANEL
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
                    'value'   => 'u-bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1 u-text-white'       => 'Primary color',
                        'u-bg-2 u-text-black'       => 'Secondary color',
                        'u-bg-silver u-text-black'  => 'Neutral Gray',
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1-glass u-text-white'       => 'Primary glass',
                        'u-bg-2-glass u-text-black'       => 'Secondary glass',
                        'u-bg-1-glass-light u-text-white' => 'Primary glass light',
                        'u-bg-2-glass-light u-text-black' => 'Secondary glass light',
                        'u-bg-1-glass-dark u-text-white'  => 'Primary glass dark',
                        'u-bg-2-glass-dark u-text-black'  => 'Secondary glass dark',
                        'u-bg-frost-4 u-text-black'       => 'Frosted',
                        'u-bg-tint-4 u-text-white'       => 'Tinted',
                        'u-bg-transparent'          => 'None',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                    ),
                    'description' => 'Background color of your row',
                ),

               array(
                   'label'   => 'Intro Text',
                   'attr'    => 'row_intro',
                   'type'    => 'text',
                   'description' => 'Introduce your row with a heading',
                ),

                array(
                    'label'   => 'Tiles Per Row',
                    'attr'    => 'width',
                    'type'    => 'select',
                    'value'   => 'u-1/1@md',
                    'options' => array(
                        'u-1/1@md' => 'One',
                        'u-1/2@md' => 'Two',
                        'u-1/3@md' => 'Three',
                        'u-1/4@md' => 'Four',
                    ),
                    'description' => 'ex. For 2 blocks, side by side you would choose "Two"',
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
       'meh_cards',
       array(
           'label'         => 'Cards',
           'listItemImage' => 'dashicons-schedule',
           // Attribute model expects 'attr', 'type' and 'label'
           // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
           'attrs' => array(

               array(
                   'label'   => 'Row Color',
                   'attr'    => 'row_color',
                   'type'    => 'select',
                   'value'   => 'u-bg-white',
                   'options' => array(
                       'u-bg-white u-text-black'   => 'White',
                       'u-bg-1 u-text-white'       => 'Primary color',
                       'u-bg-2 u-text-black'       => 'Secondary color',
                       'u-bg-silver u-text-black'  => 'Neutral Gray',
                       'u-bg-white u-text-black'   => 'White',
                       'u-bg-1-glass u-text-white'       => 'Primary glass',
                       'u-bg-2-glass u-text-black'       => 'Secondary glass',
                       'u-bg-1-glass-light u-text-white' => 'Primary glass light',
                       'u-bg-2-glass-light u-text-black' => 'Secondary glass light',
                       'u-bg-1-glass-dark u-text-white'  => 'Primary glass dark',
                       'u-bg-2-glass-dark u-text-black'  => 'Secondary glass dark',
                       'u-bg-frost-4 u-text-black'       => 'Frosted',
                       'u-bg-tint-4 u-text-white'       => 'Tinted',
                       'u-bg-transparent'          => 'None',
                       'u-bg-silver u-text-black' => 'Neutral Gray',
                   ),
                   'description' => 'Background color of your row',
               ),

              array(
                  'label'   => 'Intro Text',
                  'attr'    => 'row_intro',
                  'type'    => 'text',
                  'description' => 'Introduce your row with a heading',
               ),

               array(
                   'label'   => 'Cards Per Row',
                   'attr'    => 'width',
                   'type'    => 'select',
                   'value'   => 'u-1/1@md',
                   'options' => array(
                       'u-1/1@md' => 'One',
                       'u-1/2@md' => 'Two',
                       'u-1/3@md' => 'Three',
                       'u-1/4@md' => 'Four',
                   ),
                   'description' => 'ex. For 2 blocks, side by side you would choose "Two"',
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
            'listItemImage' => 'dashicons-schedule',
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'value'   => 'u-bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1 u-text-white'       => 'Primary color',
                        'u-bg-2 u-text-black'       => 'Secondary color',
                        'u-bg-silver u-text-black'  => 'Neutral Gray',
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1-glass u-text-white'       => 'Primary glass',
                        'u-bg-2-glass u-text-black'       => 'Secondary glass',
                        'u-bg-1-glass-light u-text-white' => 'Primary glass light',
                        'u-bg-2-glass-light u-text-black' => 'Secondary glass light',
                        'u-bg-1-glass-dark u-text-white'  => 'Primary glass dark',
                        'u-bg-2-glass-dark u-text-black'  => 'Secondary glass dark',
                        'u-bg-frost-4 u-text-black'       => 'Frosted',
                        'u-bg-tint-4 u-text-white'       => 'Tinted',
                        'u-bg-transparent'          => 'None',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                    ),
                    'description' => 'Background color of your row',
                ),

               array(
                   'label'   => 'Intro Text',
                   'attr'    => 'row_intro',
                   'type'    => 'text',
                   'description' => 'Introduce your row with a heading',
                ),

                array(
                    'label'   => 'Blocks Per Row',
                    'attr'    => 'width',
                    'type'    => 'select',
                    'value'   => 'u-1/1@md',
                    'options' => array(
                        'u-1/1@md' => 'One',
                        'u-1/2@md' => 'Two',
                        'u-1/3@md' => 'Three',
                        'u-1/4@md' => 'Four',
                    ),
                    'description' => 'ex. For 2 blocks, side by side you would choose "Two"',
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
                    'label'   => 'Block Type',
                    'attr'    => 'block_type',
                    'type'    => 'select',
                    'value'   => 'block',
                    'options' => array(
                        'card-block' => 'Card',
                        'flag-block'  => 'Panel',
                   ),
                    'multiple'    => false,
                    'description' => '*Block = Large image on top. *Panel = Small image to the left.',
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
                    'value'   => 'u-bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1 u-text-white'       => 'Primary color',
                        'u-bg-2 u-text-black'       => 'Secondary color',
                        'u-bg-silver u-text-black'  => 'Neutral Gray',
                        'u-bg-white u-text-black'   => 'White',
                        'u-bg-1-glass u-text-white'       => 'Primary glass',
                        'u-bg-2-glass u-text-black'       => 'Secondary glass',
                        'u-bg-1-glass-light u-text-white' => 'Primary glass light',
                        'u-bg-2-glass-light u-text-black' => 'Secondary glass light',
                        'u-bg-1-glass-dark u-text-white'  => 'Primary glass dark',
                        'u-bg-2-glass-dark u-text-black'  => 'Secondary glass dark',
                        'u-bg-frost-4 u-text-black'       => 'Frosted',
                        'u-bg-tint-4 u-text-white'       => 'Tinted',
                        'u-bg-transparent'          => 'None',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                    ),
                    'description' => 'Background color of your row',
                ),

               array(
                   'label'   => 'Intro Text',
                   'attr'    => 'row_intro',
                   'type'    => 'text',
                   'description' => 'Introduce your row with a heading',
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
