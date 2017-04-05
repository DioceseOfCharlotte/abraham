<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>

		<?php get_template_part( 'components/img', 'hd' ); ?>

		<?php get_template_part( 'components/entry', 'header' ); ?>

		<?php if ( has_excerpt() ) { ?>
		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_content(); ?>
		</div>
		<?php } ?>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>
