<?php
/**
 * @package Abraham
 */
?>

<?php
tha_entry_before(); ?>

    <article <?php hybrid_attr( 'post' ); ?>>

<?php
tha_entry_top(); ?>

    <?php if ( is_singular( get_post_type() ) ) : ?>

          <?php get_template_part( 'partials/single', 'content' ); ?>

      	  <?php get_template_part( 'partials/single', 'footer' ); ?>

    <?php else : // If not viewing a single post. ?>

      		<?php get_template_part( 'partials/archive', 'content' ); ?>

    <?php endif; // End single post check. ?>

<?php
tha_entry_bottom(); ?>

    </article><!-- .entry -->

<?php
tha_entry_after();