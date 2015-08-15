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

    shortcode_ui_register_for_shortcode(
        'meh_cards',
        array(
            'label'         => 'Cards',
            'listItemImage' => 'dashicons-grid-view',
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(
                array(
                    'label'   => 'Row Color',
                    'attr'    => 'row_color',
                    'type'    => 'select',
                    'value'   => 'bg-white',
                    'options' => array(
                        'bg-white black'      => 'White',
                        'bg-1 white'    => 'Primary Color',
                        'bg-2 black'          => 'Secondary Color',
                        'bg-silver black' => 'Neutral Gray',
                        'bg-transparent' => 'None',

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
                    'label'   => 'Card Color',
                    'attr'    => 'card_color',
                    'type'    => 'select',
                    'value'   => 'bg-white',
                    'options' => array(
                        'bg-white black'      => 'White',
                        'bg-1 white'          => 'Primary Color',
                        'bg-2 black'          => 'Secondary Color',
                        'bg-silver black' => 'Neutral Gray',
                        'bg-transparent shadow0' => 'None',
                   ),
                    'description' => 'Background color of your content card',
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
     * PANEL
     */
    shortcode_ui_register_for_shortcode(
        'meh_block',
        array(
            'label'         => 'Block',
            'listItemImage' => '<img width="60px" height="60px" src="'.esc_url($abraham_dir.'images/sidebar-left.svg').'" />',
            // Attribute model expects 'attr', 'type' and 'label'
            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
            'attrs' => array(
                array(
                    'label'   => 'Icon',
                    'attr'    => 'icon',
                    'type'    => 'select',
                    'options' => array(
                        ''         => 'None',
                        'quote'    => 'Quote',
                        'book'     => 'Book',
                        'calendar' => 'Calendar',
                        'church'   => 'Church',
                        'sports'   => 'Sports',
                        'image'    => 'Image',
                        'chat'     => 'Chat',
                        'pencils'  => 'Pencils',
                   ),
                        'description' => 'Don\'t use this if you are using an image.',
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
                        'block' => 'Block',
                        'flag'  => 'Panel',
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
