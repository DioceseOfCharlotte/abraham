<?php
/**
 * Breadcrumbs.
 *
 * @package Abraham
 */

if ( function_exists( 'breadcrumb_trail' ) ) :

	breadcrumb_trail( array(
		'container'     => 'nav',
		'show_on_front' => false,
		'show_browse'   => false,
	));

endif;
