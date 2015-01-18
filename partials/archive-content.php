<?php
/**
 * @package Abraham
 */
?>

<div <?php hybrid_attr( 'entry-summary' ); ?>>

<?php
  get_the_image();
  the_excerpt();
?>

</div>