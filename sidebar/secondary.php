<?php if ( ! is_active_sidebar( 'secondary' ) ) {
  return;
}
?>

<div <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>
  <?php dynamic_sidebar( 'secondary' ); ?>
</div><!-- #secondary -->
