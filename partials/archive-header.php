<?php
/**
 * @package Abraham
 */
?>

<header class="entry-header">

<span class="entry-format"><?php abe_post_format_link(); ?></span>

  <?php
  the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '>
  <a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' );
  ?>

</header>
