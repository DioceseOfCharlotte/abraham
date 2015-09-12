<?php
tha_footer_before(); ?>

<footer <?php hybrid_attr('footer'); ?>>

    <?php tha_footer_top(); ?>

    <div <?php hybrid_attr('container', 'footer'); ?>>
        <?php hybrid_get_sidebar('footer'); ?>
    </div>

    <p class="credit mdl-mega-footer--bottom-section">
        <?php printf(__('&#169; %1$s %2$s', 'abraham'), date_i18n('Y'), hybrid_get_site_link()); ?>
    </p><!-- .credit -->

    <?php tha_footer_bottom(); ?>

</footer>

<?php tha_footer_after(); ?>

<?php
wp_footer();
