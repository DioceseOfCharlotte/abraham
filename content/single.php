<?php
/**
 * Single post template.
 *
 * @package abraham
 */

// if ( ! hybrid_post_has_content() && ! is_singular( 'gravityview' ) ) {
// 	return;
// }
?>

<article <?php hybrid_attr( 'post' ); ?>>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>

<?php
if ( comments_open() || get_comments_number() ) :
	comments_template( '/content/comments.php' );
endif;
