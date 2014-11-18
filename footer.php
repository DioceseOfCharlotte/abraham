				<?php hybrid_get_sidebar( 'primary' ); ?>

			</div><!-- #main -->

			<?php hybrid_get_sidebar( 'subsidiary' ); ?>

		</div><!-- .wrap -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div class="wrap footer-wrap">

				<?php hybrid_get_menu( 'social' ); ?>

				<p class="credit">
					<?php printf(
						/* Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link. */
						__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'abraham' ),
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
					); ?>
				</p><!-- .credit -->

			</div><!-- .wrap -->

		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); ?>

</body>
</html>