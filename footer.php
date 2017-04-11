<?php
/**
 * Footer Template.
 *
 * @package Abraham
 */

?>
	<footer <?php hybrid_attr( 'footer' ); ?>>

		<?php hybrid_get_sidebar( 'footer' ); ?>

		<p class="credit u-py1 u-bg-tint-1 u-text-center">
			<?php abe_do_copyright_text(); ?>
		</p><!-- .credit -->

	</footer>

<!-- </div> --><!-- /.layout -->
<?php hybrid_get_sidebar( 'secondary' ); ?>
</div><!-- /.site-container -->

<?php wp_footer(); ?>

</body>
</html>
