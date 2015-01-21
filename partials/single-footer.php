<?php
/**
 * @package Abraham
 */
?>

<footer class="entry-footer">

	<?php
	edit_post_link( esc_html__( 'Edit', 'abraham' ), '<span class="edit-link">', '</span>' );


		hybrid_post_terms( array(
			'taxonomy' 	=> 'post_tag',
			'sep' 		=> ' ',
			'before' 	=> '<br />'
			) );
?>

</footer>
