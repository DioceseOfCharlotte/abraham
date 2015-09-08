<?php

hybrid_post_terms(array(
    'taxonomy' => 'category',
    'text'     => __('Posted in %s', 'abraham')
));

hybrid_post_terms(array(
    'taxonomy' => 'post_tag',
    'text'     => __('Tagged %s', 'abraham'),
    'before'   => '<br />'
));
