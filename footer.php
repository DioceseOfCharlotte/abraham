<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Abraham
 */
?>

		<?php hybrid_get_sidebar( 'primary' ); ?>

	</div><!-- #container -->

	<?php tha_footer_before(); ?>

	<footer <?php hybrid_attr( 'footer' ); ?>>

	<?php tha_footer_top(); ?>

		<?php hybrid_get_sidebar( 'footer-widgets' ); ?>

		<div class="site-info">

			<div class="wrap wrap__footer">

				<?php if ( get_theme_mod( 'footer-text', customizer_library_get_default( 'footer-text' ) ) != '' ) : ?>
				<div class="credit">
					<?php echo get_theme_mod( 'footer-text', customizer_library_get_default( 'footer-text' ) ); ?>
				</div><!-- .credit -->
				<?php endif; ?>

				<?php hybrid_get_menu( 'social' ); ?>

			</div><!-- .wrap -->

		</div><!-- .site-info -->

	<?php tha_footer_bottom(); ?>

	</footer><!-- #footer -->

	<?php tha_footer_after(); ?>

</div><!-- #page -->

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>
