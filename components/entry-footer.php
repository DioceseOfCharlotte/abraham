<?php
/**
 * Post foooter
 *
 * @package abraham
 */
abe_edit_link();

if ( 'post' !== get_post_type() || ! is_single( 'get_the_ID' ) )
	return;
?>
<footer <?php hybrid_attr( 'entry-footer' ); ?>>
	<?php
	if ( 'post' === get_post_type() ) {
		get_template_part( 'components/entry', 'terms' );
	}
	if ( is_single( 'get_the_ID' ) || is_page( 'get_the_ID' ) ) {
		wp_link_pages();
	} ?>

</footer><!-- .entry-footer -->
