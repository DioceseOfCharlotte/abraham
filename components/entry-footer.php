<?php if ( !is_single( get_the_ID() ) ) {
	return;
} ?>
<footer class="entry-footer">
	<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( 'Posted in %s', 'abraham' ) ) ); ?>
	<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged %s', 'abraham' ), 'before' => '<br />' ) ); ?>
</footer><!-- .entry-footer -->
