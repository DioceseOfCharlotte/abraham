<?php
/**
 * The default author box template for archives.
 *
 * If you need to make changes to this template, copy it into your theme or
 * child theme in the following format: '/flagship/author-box-archive.php'.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.4.0
 */
?>
<section <?php hybrid_attr( 'author-box', 'archive' ); ?>>

	<div class="avatar-wrap">
		<?php echo get_avatar( get_the_author_meta( 'email' ), 125, '', get_the_author() ); ?>
	</div><!-- .avatar-wrap -->

	<div class="author-info">

		<h3 class="author-box-title">
			<?php _e( 'Written by ', 'flagship-library' ); ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<span class="name" itemprop="name"><?php the_author(); ?></span>
			</a>
		</h3>

		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="description" itemprop="description">
				<?php echo wpautop( get_the_author_meta( 'description' ) ) ?>
			</div>
		<?php endif; ?>

	</div><!-- .author-info -->

</section><!-- .author-box -->
