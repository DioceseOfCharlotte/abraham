<?php
/**
 * Video format template.
 *
 * @package abraham
 */

?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php tha_entry_top(); ?>

		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php
			echo $video = hybrid_media_grabber(
				array(
					'type'        => 'video',
					'split_media' => true,
				)
			);
			?>
			<h2 <?php hybrid_attr( 'entry-title' ); ?>>
				<a class="entry-title-link u-1of1 u-inline-flex u-flex-center" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>

			<div <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php tha_entry_content_before(); ?>
				<?php the_excerpt(); ?>
				<?php tha_entry_content_after(); ?>
			</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

<?php tha_entry_bottom(); ?>

</article>
