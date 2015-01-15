<?php
/**
 * @package Abraham
 */

if ( function_exists( 'breadcrumb_trail' ) ) :

	breadcrumb_trail(
		array(
			'container'     => 'nav',
			'separator'     => '/',
			'show_browse'   => false,
			'show_on_front' => false,
		)
	);

endif;
