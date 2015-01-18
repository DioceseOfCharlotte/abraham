<?php
/**
 * @package Abraham
 */

tha_entry_before(); ?>

  <article <?php hybrid_attr( 'post' ); ?>>

<?php
tha_entry_top();

    if ( is_page() ) :

      get_template_part( 'partials/single', 'header' );

      get_template_part( 'partials/single', 'content' );

    else : // If not viewing a single page.

      get_template_part( 'partials/archive', 'header' );

      get_template_part( 'partials/archive', 'content' );

    endif; // End single page check.

tha_entry_bottom(); ?>

  </article><!-- .entry -->

<?php
tha_entry_after();