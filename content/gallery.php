<?php
/**
 * List of related articles.
 *
 * @package abraham
 */

?>
<section <?php hybrid_attr('post'); ?>>

        <div class="mdl-card__supporting-text u-1/1">
            <?php tha_entry_content_before(); ?>
            <?php the_content(); ?>
            <?php tha_entry_content_after(); ?>
        </div>
</section>
