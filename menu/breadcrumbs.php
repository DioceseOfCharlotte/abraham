<?php if ( ! function_exists( 'breadcrumb_trail' ) ) {
  return;
}
?>

<div class="crumb-container">
	<?php breadcrumb_trail(
		array(
			'container'     => 'nav',
			'separator'     => '/',
			'show_browse'   => false,
			'show_on_front' => false,
		)
	); ?>
</div>
