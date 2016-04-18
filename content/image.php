<?php
/**
 * List of related articles.
 *
 * @package abraham
 */

?>
<section <?php hybrid_attr( 'post' ); ?>>
	<?php
		get_the_image(array(
			'size' => 'abe-hd',
			'link_to_post' => false,
			'image_class' => 'u-br u-block u-1of1',
			'default_image' => get_template_directory_uri() . '/images/blank.jpg',
		));
	?>

<div class="u-flex u-flex-col u-flex-je u-text-white u-abs u-bottom0 u-left0 u-1of1 u-top0 u-grad-overlay u-color-inherit">
		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<h2 <?php hybrid_attr( 'entry-title' ); ?>>
				<?php the_title(); ?>
			</h2>
		</header>

		<?php get_template_part( 'components/entry', 'footer' ); ?>
</div>
<a class="u-1of1 u-abs u-bottom0 u-z1 u-top0 u-left0" href="<?php the_permalink(); ?>"></a>
</section>
