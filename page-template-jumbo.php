<?php 
/**
 * Template Name: Hero-Home
 */

 get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?> class="home-site-main">

  <?php if ( have_posts() ) : // Checks if any posts were found. ?>

    <?php while ( have_posts() ) : // Begins the loop through found posts. ?>

      <?php the_post(); // Loads the post data. ?>

      <?php the_content(); ?>

        <?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

            <style type="text/css" id="slider-background-css">.flexslider-background { 
              background: url(<?php echo $image[0]; ?>) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
               }</style>
               <?php endif; ?>


    <?php endwhile; // End found posts loop. ?>

    <?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

  <?php else : // If no posts were found. ?>

    <?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

  <?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php hybrid_get_sidebar( 'featured' ); // Loads the sidebar/featured.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>