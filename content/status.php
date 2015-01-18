<?php
/**
 * @package Abraham
 */

tha_entry_before(); ?>

  <article <?php hybrid_attr( 'post' ); ?>>

<?php
tha_entry_top();

    if ( is_singular( get_post_type() ) ) :

      if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

        <header class="entry-header">
          <?php echo get_avatar( get_the_author_meta( 'email' ) ); ?>
        </header><!-- .entry-header -->

      <?php
      endif; // End avatars check.

      get_template_part( 'partials/single', 'content' );

      get_template_part( 'partials/single', 'footer' );

    else : // If not viewing a single post.

      if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

        <header class="entry-header">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php echo get_avatar( get_the_author_meta( 'email' ) ); ?></a>
        </header><!-- .entry-header -->

      <?php
      endif; // End avatars check.

      get_template_part( 'partials/single', 'content' );

    endif; // End single post check.

tha_entry_bottom(); ?>

  </article><!-- .entry -->

<?php
tha_entry_after();
