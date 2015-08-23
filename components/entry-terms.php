<?php

hybrid_post_terms(array(
    'taxonomy' => 'category',
    'text'     => __('Posted in %s', 'stargazer')
));

hybrid_post_terms(array(
    'taxonomy' => 'post_tag',
    'text'     => __('Tagged %s', 'stargazer'),
    'before'   => '<br />'
));
