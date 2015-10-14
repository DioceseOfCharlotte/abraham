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
            'listItemImage' => 'dashicons-schedule',
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'value'   => 'bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'      => 'White',
                        'u-bg-1 u-text-white'    => 'Primary Color',
                        'u-bg-2 u-text-black'          => 'Secondary Color',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                        'u-bg-transparent' => 'None',
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
                    'query'    => array('post_type' => 'cpt_archive'),
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
                    'value'   => 'bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'      => 'White',
                        'u-bg-1 u-text-white'    => 'Primary Color',
                        'u-bg-2 u-text-black'          => 'Secondary Color',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                        'u-bg-transparent' => 'None',
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
                    'query'    => array('post_type' => 'page'),
                    'multiple' => true,
               ),
           ),
       )
   );

    /*
     * Tabs
     */
    shortcode_ui_register_for_shortcode(
        'meh_tabs',
        array(
            'label'         => 'Tabs',
            'listItemImage' => 'dashicons-images-alt2',
            'attrs'         => array(

                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'value'   => 'bg-white',
                    'options' => array(
                        'u-bg-white u-text-black'      => 'White',
                        'u-bg-1 u-text-white'    => 'Primary Color',
                        'u-bg-2 u-text-black'          => 'Secondary Color',
                        'u-bg-silver u-text-black' => 'Neutral Gray',
                        'u-bg-transparent' => 'None',
                    ),
                    'description' => 'Background color of your row',
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
                    'query'    => array('post_type' => 'page'),
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
            'listItemImage' => 'dashicons-menu',
            'attrs'         => array(

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
                    'query'    => array('post_type' => 'page'),
                    'multiple' => true,
               ),
           ),
       )
   );
}
