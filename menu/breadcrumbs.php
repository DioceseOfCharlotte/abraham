<?php if ( ! function_exists( 'breadcrumb_trail' ) ) {
  return;
}
?>
	<?php breadcrumb_trail(
		array(
			'container'     => 'nav',
			'separator'     => '/',
			'before' 		=> '<div class="wrapper breadcrumb__wrapper">',
			'after' 		=> '</div>',
			'show_browse'   => false,
			'show_on_front' => false,
		)
	); ?>

