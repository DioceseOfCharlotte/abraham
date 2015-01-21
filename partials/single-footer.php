<?php
/**
 * @package Abraham
 */
?>

<footer class="entry-footer">


	<div class="entry-byline">
	<?php hybrid_post_author(); ?>
		<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
	<?php
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) );
			echo '</span>';
		}
		edit_post_link( esc_html__( 'Edit', 'abraham' ), '<span class="edit-link">', '</span>' );
	 ?>
	</div>

	<div class="entry-categories">
	<?php

		hybrid_post_terms( array(
			'taxonomy'	=> 'category',
			'sep' 		=> ' ',
			'before' 	=> '<br />'
			) );
		hybrid_post_terms( array(
			'taxonomy' 	=> 'post_tag',
			'sep' 		=> ' ',
			'before' 	=> '<br />'
			) );
	?>
	</div>

</footer>
