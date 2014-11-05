<article <?php hybrid_attr( 'post' ); ?>>

		<?php get_the_image(); ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-meta">
				<?php abraham_posted_on(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
</article><!-- .entry -->