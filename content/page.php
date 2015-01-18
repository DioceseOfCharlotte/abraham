<?php
/**
 * @package Abraham
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

<?php if ( is_page() ) : ?>

	<?php get_template_part( 'partials/single', 'header' ); ?>

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php get_the_image( array( 'size' => 'full', 'link_to_post' => false ) ); ?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div><!-- .entry-content -->

<?php else : // If not viewing a single page. ?>

          <?php get_template_part( 'partials/archive', 'header' ); ?>

          <?php get_template_part( 'partials/archive', 'content' ); ?>

<?php endif; // End single page check. ?>

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();