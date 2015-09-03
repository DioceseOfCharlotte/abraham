<?php

add_action('init', 'meh_post_type_layouts_supports');

function meh_post_type_layouts_supports() {
    add_post_type_support('thursday_packet', 'theme-layouts');
    add_post_type_support('gravityview', 'theme-layouts');
    add_post_type_support('sc_event', 'theme-layouts');
}
