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
				<div class="credit">
					<?php printf(
							__( 'Copyright &#169; %1$s %2$s.', 'abraham' ),
							date_i18n( 'Y' ), hybrid_get_site_link()
								); ?>
				</div><!-- .credit -->

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
