<?php if ( ! is_active_sidebar( 'primary' ) ) {
  return;
}
?>

<div <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
  <?php dynamic_sidebar( 'primary' ); ?>
</div><!-- #primary -->
