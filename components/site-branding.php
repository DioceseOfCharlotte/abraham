<div <?php hybrid_attr('branding'); ?>>

	<?php if ( get_theme_mod( 'abraham_logo') ) { ?>
		<a class="logo-image u-z4 u-p1" href="<?= esc_url( home_url( '/' ) ); ?>" rel="home">
			<img class="site-logo" src="<?= esc_url( get_theme_mod( 'abraham_logo' ) ); ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ); ?>" >
		</a>
	<?php } ?>

	<div class="title-text u-flex u-flexed-start u-flex-column-rev u-p1">
		<?php hybrid_site_title(); ?>
		<?php hybrid_site_description(); ?>
	</div>

</div>
