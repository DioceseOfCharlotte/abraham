<?php
/**
 * Link format template.
 *
 * @package abraham
 */

?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php tha_entry_top(); ?>

		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php
				get_the_image(array(
					'size' => 'abe-card-md',
					'image_class' => 'u-br-t u-1of1',
					'before'             => '<div class="card-img u-overflow-hidden">',
					'after'              => '</div>',
				));
			?>
<?php the_title( '<a class="btn btn-hollow u-1of1 u-h4" href="' . hybrid_get_the_post_format_url() . '">', is_rtl() ? ' <span class="meta-nav">&larr;</span>' : ' <span class="meta-nav">&rarr;</span></a>' ); ?>
		</header>

<?php tha_entry_bottom(); ?>

</article>
