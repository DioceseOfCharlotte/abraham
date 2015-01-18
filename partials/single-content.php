<?php
/**
 * @package Abraham
 */
?>

<div <?php hybrid_attr( 'entry-content' ); ?>>

  <?php
  get_the_image();
  the_content();
  wp_link_pages();
  ?>

</div>