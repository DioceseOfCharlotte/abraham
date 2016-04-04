<?php
/**
 * Footer Template.
 *
 * @package Abraham
 */

?>
<?php tha_footer_before(); ?>

	<footer <?php hybrid_attr( 'footer' ); ?>>

		<?php tha_footer_top(); ?>

		<?php hybrid_get_sidebar( 'footer' ); ?>

		<p class="credit u-py1 u-bg-tint-1 u-text-center mdl-mega-footer--bottom-section">
			<?php printf( __( '&#169; %1$s %2$s', 'abraham' ), date_i18n( 'Y' ), hybrid_get_site_link() ); ?>
		</p><!-- .credit -->

		<?php tha_footer_bottom(); ?>

	</footer>

<?php tha_footer_after(); ?>

</div><!-- /.layout -->

</div><!-- /.site-container -->

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>
