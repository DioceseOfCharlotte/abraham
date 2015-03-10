<?php
/**
 * The Default Footer Widgets Sidebar Template.
 *
 * If you need to make changes to this template, copy it into your theme or
 * child theme in the following format: '/flagship/footer-widgets.php'.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.4.0
 */
?>
<div <?php hybrid_attr( 'footer-widgets' ); ?>>

	<div <?php hybrid_attr( 'wrap', 'footer-widgets' ); ?>>

		<?php while ( $counter <= absint( $this->footer_widgets[0] ) ) : ?>

			<div <?php hybrid_attr( "footer-widgets-{$counter}" ); ?>>

				<?php if ( is_active_sidebar( "footer-{$counter}" ) ) : ?>

					<?php dynamic_sidebar( "footer-{$counter}" ); ?>

				<?php endif; ?>

			</div><!-- .footer-widgets-<?php echo $counter; ?> -->

			<?php $counter++; ?>

		<?php endwhile; ?>

	</div>

</div>
