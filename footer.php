<footer <?php hybrid_attr('footer'); ?>>

    <div <?php hybrid_attr('container', 'footer'); ?>>
        <?php hybrid_get_sidebar('footer'); ?>
    </div>

        <p class="credit bg-darken-1 center py2">
            <?php printf(
                __('&#169; %1$s %2$s', 'abraham'),
                date_i18n('Y'), hybrid_get_site_link()
           ); ?>
        </p><!-- .credit -->

</footer>

<?php wp_footer(); ?>

</body>
</html>
