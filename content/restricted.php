<?php
/**
 * Nothing found template.
 *
 * @package abraham
 */

if ( is_single( get_the_ID() ) ) {
?>

<article <?php hybrid_attr( 'post' ); ?>>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

		<?php comments_template( '', true ); ?>

</article>

<?php } ?>
