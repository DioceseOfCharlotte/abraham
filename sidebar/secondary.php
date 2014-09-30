<?php if ( ! is_active_sidebar( 'secondary' ) ) {
  return;
}
?>

<div <?php hybrid_attr( 'sidebar_2', 'secondary' ); ?>>
  <?php dynamic_sidebar( 'secondary' ); ?>
</div><!-- #secondary -->
