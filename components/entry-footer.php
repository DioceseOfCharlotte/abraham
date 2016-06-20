<?php if ( ! is_single( get_the_ID() ) ) {
	return;
} ?>
<footer <?php hybrid_attr( 'entry-footer' ); ?>>
	<?php get_template_part( 'components/entry', 'terms' ); ?>
</footer><!-- .entry-footer -->
