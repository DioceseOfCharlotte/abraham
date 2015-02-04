<?php
/**
 * @package Abraham
 */

tha_entry_before(); ?>

  <article <?php hybrid_attr( 'post' ); ?>>

<?php
tha_entry_top();

    if ( is_singular( get_post_type() ) ) :

    	?>
    <blockquote>
    <?php echo get_post_meta( get_the_ID(), 'quote', true ); ?>
    <cite>
    <?php echo get_post_meta( get_the_ID(), 'citation', true ); ?>
    </cite>
    </blockquote>
<?php



      get_template_part( 'partials/single', 'content' );

      get_template_part( 'partials/single', 'footer' );

    else : // If not viewing a single post.

          	?>
    <blockquote>
    <?php echo get_post_meta( get_the_ID(), 'quote', true ); ?>
    <cite>
    <?php echo get_post_meta( get_the_ID(), 'citation', true ); ?>
    </cite>
    </blockquote>
<?php

    endif; // End single post check.

tha_entry_bottom(); ?>

  </article><!-- .entry -->

<?php
tha_entry_after();
