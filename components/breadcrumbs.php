<?php

if ( function_exists( 'breadcrumb_trail' ) ) :

	breadcrumb_trail(array(
		'container'       => 'nav',
		'show_on_front'   => false,
		'show_browse'     => false,
		'before'          => '<span class="u-text-shadow u-h4">',
		'after'           => '</span>',
	));

endif;
