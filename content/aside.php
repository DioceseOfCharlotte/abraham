<?php
/**
 * List of related articles.
 *
 * @package abraham
 */
?>
<section <?php hybrid_attr('post'); ?>>
  <div class="mdl-card__title mdl-card--expand">
      <div <?php hybrid_attr('entry-content'); ?>>
          <?php tha_entry_content_before(); ?>
          <?php the_content(); ?>
          <?php tha_entry_content_after(); ?>
      </div>
  </div>
</section>
