<?php
/**
 * Returns the parent theme editor stylesheet URI.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */

get_the_image(array(
	'image_class' => 'u-1of1',
	'default_image' => abe_get_default_image(),
	'before'             => '<div class="card-img u-overflow-hidden">',
	'after'              => '</div>',
));
