<?php if ( ! is_active_sidebar( 'footer' ) ) {
  return;
}
?>

<div <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
  <?php dynamic_sidebar( 'footer' ); ?>
</div><!-- #footer -->
