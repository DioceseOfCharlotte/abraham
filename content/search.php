<?php
/**
 * Search results template.
 *
 * @package abraham
 */

?>
<article class="u-1of1 u-overflow-hidden u-text-wrap u-bg-white u-br u-shadow1 u-mb2 u-flex u-flex-wrap">

	<?php tha_entry_top(); ?>

	<?php get_template_part( 'components/img', 'thumb' ); ?>

	<div class="flag-body u-flexed-1">

		<h2 class="u-f-plus u-m0 u-p0">
			<a class="u-inline-flex u-link u-1of1 u-p2 u-pb1 u-flex-jb" href="<?php the_permalink(); ?>"><?php the_title(); ?><?php abe_do_svg( 'arrow-right', 'sm' ) ?></a>
		</h2>

		<div class="entry-summary u-p2 show-icons">
			<?php tha_entry_content_before(); ?>
			<?php the_excerpt(); ?>
			<?php tha_entry_content_after(); ?>
		</div>

	</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

	<?php tha_entry_bottom(); ?>

</article>
