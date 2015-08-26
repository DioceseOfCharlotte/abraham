<?php tha_footer_before(); ?>

<footer <?php hybrid_attr('footer'); ?>>

<?php tha_footer_top(); ?>

    <div <?php hybrid_attr('container', 'footer'); ?>>
        <?php hybrid_get_sidebar('footer'); ?>
    </div>

        <p class="credit bg-darken-2 text-center py2">
            <?php printf(
                __('&#169; %1$s %2$s', 'abraham'),
                date_i18n('Y'), hybrid_get_site_link()
           ); ?>
        </p><!-- .credit -->

<?php tha_footer_bottom(); ?>

</footer>

<?php tha_footer_after(); ?>

<?php wp_footer(); ?>

<?php tha_body_bottom(); ?>

</body>
</html>
