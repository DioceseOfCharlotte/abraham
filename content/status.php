<?php
/**
 * @package Abraham
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

<?php tha_entry_top(); ?>

<?php if ( is_singular( get_post_type() ) ) : ?>

	<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

		<header class="entry-header">
			<?php echo get_avatar( get_the_author_meta( 'email' ) ); ?>
		</header><!-- .entry-header -->

	<?php endif; // End avatars check. ?>

          <?php get_template_part( 'partials/single', 'content' ); ?>

          <?php get_template_part( 'partials/single', 'footer' ); ?>

<?php else : // If not viewing a single post. ?>

	<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

		<header class="entry-header">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_avatar( get_the_author_meta( 'email' ) ); ?></a>
		</header><!-- .entry-header -->

	<?php endif; // End avatars check. ?>

	<?php get_template_part( 'partials/single', 'content' ); ?>

<?php endif; // End single post check. ?>

<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
