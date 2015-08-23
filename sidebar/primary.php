<?php
if (!is_active_sidebar('primary')) {
    return;
} ?>

    <aside <?php hybrid_attr('sidebar', 'primary'); ?>>
        <?php dynamic_sidebar('primary'); ?>
    </aside>
