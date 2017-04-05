<?php
/**
 * Page template.
 *
 * @package abraham
 */

?>

<article <?php hybrid_attr( 'post' ); ?>>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>
