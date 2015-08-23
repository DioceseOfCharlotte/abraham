<?php
if (has_nav_menu('primary')) : ?>

    <nav <?php hybrid_attr('menu', 'primary'); ?>>

        <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => '',
                'depth'          => 2,
                'menu_id'        => 'menu-primary__list',
                'menu_class'     => 'menu__list menu-primary__list inline-block',
                'fallback_cb'    => '',
                'items_wrap'     => '<ul id="%s" class="%s">%s</ul>'
            ));
        ?>
    </nav>

<?php
endif;
