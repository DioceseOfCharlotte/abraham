<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>

<div class="crumb-container">
	<?php breadcrumb_trail(
		array( 
			'container'     => 'nav', 
			'separator'     => '/',
			'show_browse'   => false,
			'show_on_front' => true,
		) 
	); ?>
</div>
<?php endif; // End check for breadcrumb support. ?>