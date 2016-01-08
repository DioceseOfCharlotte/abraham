<?php if ( is_singular() || is_front_page() ) {
    return;
} ?>
<footer class="entry-footer">
    <?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( 'Posted in %s', 'abraham' ) ) ); ?>
    <?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged %s', 'abraham' ), 'before' => '<br />' ) ); ?>
    <?php edit_post_link(); ?>
</footer><!-- .entry-footer -->
