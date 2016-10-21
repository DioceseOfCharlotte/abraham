<?php
/**
 * Returns the parent theme editor stylesheet URI.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */

get_the_image(array(
	'size'               => 'abe-card',
	'image_class'        => 'u-of-cover',
	'default_image' 	=> abe_get_default_image(),
	'link_to_post'		=> false,
	'attachment' 		=> false,
));
