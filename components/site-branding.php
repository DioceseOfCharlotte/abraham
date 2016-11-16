<div <?php hybrid_attr( 'branding' ); ?>>
<a class="site-home-link u-inline-flex u-no-link u-flex-center" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php endif; // End check for custom logo. ?>

<div class="title-text u-flex u-flex-col u-p05">
	<?php
	if ( is_front_page() ) : ?>
		<h1 <?php hybrid_attr( 'site-title' ) ?>><?php bloginfo( 'name' ); ?></h1>
	<?php else : ?>
		<h2 <?php hybrid_attr( 'site-title' ) ?>><?php bloginfo( 'name' ); ?></h2>
	<?php
	endif; ?>

	<?php hybrid_site_description(); ?>
</div>
</a>
</div>
