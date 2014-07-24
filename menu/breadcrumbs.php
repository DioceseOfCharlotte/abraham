<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>

<div class="grid container">
<div class="u-size-1of1">
	<?php breadcrumb_trail(
		array( 
			'container'     => 'nav', 
			'separator'     => '/',
			'show_browse'   => false,
			'show_on_front' => true,
		) 
	); ?>
</div>
</div>
<?php endif; // End check for breadcrumb support. ?>