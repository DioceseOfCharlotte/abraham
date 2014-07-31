<article <?php hybrid_attr( 'post' ); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Page Not Found', 'abraham' ); ?></h1>
	</header><!-- .entry-header -->

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php echo wpautop( __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'abraham' ) ); ?>
    <?php get_search_form(); ?>
	</div><!-- .entry-content -->

</article><!-- .entry -->