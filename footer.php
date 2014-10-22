<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Abraham
 */
?>

	</div><!-- .main-container -->


</div><!-- .site -->

<?php hybrid_get_sidebar( 'footer' ); ?>

	<footer <?php hybrid_attr( 'footer' ); ?>>
		<p class="site-info copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
	</footer><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>
