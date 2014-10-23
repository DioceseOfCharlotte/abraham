<?php global $post;
		$phone_entries = get_post_meta( get_the_ID(), 'phone_group', true );
		$first_name = get_post_meta( get_the_id(), '_doc_emp_first_name', true );
		$last_name = get_post_meta( get_the_id(), '_doc_emp_last_name', true );
		$emp_emails = get_post_meta( get_the_id(), '_doc_emp_email', true );
?>

<?php
// Find connected pages
$connected = new WP_Query( array(
	'connected_type' => 'departments_to_employees',
	'connected_items' => $post,
	'nopaging' => true,
) );
?>



<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

	<div class="doc-card layout__item palm-1-1 sm-1-2 lg-1-3">
<div class="card--staff layout" itemscope itemtype="http://schema.org/Person">
<div class="layout__item card__avatar">
<?php get_the_image( array( 'size' => 'directory-thumbnail' ) ); ?>
</div>
<div class="card__details layout__item layout layout__column">
  <header class="card-header all-1-1" itemprop="name"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></header><!-- .card-header -->

<div class="layout layout__item middle--info">
<div class="card__titles layout__item">
  <?php
// Display connected pages
if ( $connected->have_posts() ) :
?>
<div class="card__department">
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
    <div><?php echo  p2p_get_meta( get_post()->p2p_id, 'role', true ); ?></div>
<?php endwhile; ?>
</div>
<?php
wp_reset_postdata();
endif;
?>
</div>
<div class="card__phone-list layout__item">
  <?php
    foreach ( $phone_entries as $key => $phone_entry ) {
?>
<div class="card__phone"> <i class="fa
<?php echo $phone_entries [$key]['phone_type_select']; ?>"></i>
<a href="tel:<?php echo $phone_entries [$key]['emp_phone']; ?>" itemprop="telephone"><?php echo $phone_entries [$key]['emp_phone']; ?></a></div>
<?php
 }
?>
</div>
</div>
<?php
    if($emp_emails){
foreach ( $emp_emails as $email ) { ?>
<div class="cardemail"><i class="fa fa-envelope"></i><a href="mailto:<?php echo  $email; ?>" itemprop="email"><?php echo  $email; ?></a></div>
<?php
}
}
?>
</div>
</div>
</div><!-- .doc-card -->

<?php else : // If not viewing a single post. ?>

<div class="card--staff layout shadow-z1" itemscope itemtype="http://schema.org/Person">
<div class="layout__item card__avatar">
<?php get_the_image( array( 'size' => 'directory-thumbnail' ) ); ?>
</div>
<div class="card__details layout__item layout layout__column">
	<header class="card-header all-1-1" itemprop="name"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></header><!-- .card-header -->

<div class="layout layout__item middle--info">
<div class="card__titles layout__item">
	<?php
// Display connected pages
if ( $connected->have_posts() ) :
?>
<div class="card__department">
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
		<div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<div><?php echo  p2p_get_meta( get_post()->p2p_id, 'role', true ); ?></div>
<?php endwhile; ?>
</div>
<?php
wp_reset_postdata();
endif;
?>
</div>
<div class="card__phone-list layout__item">
	<?php
		foreach ( $phone_entries as $key => $phone_entry ) {
?>
<div class="card__phone"> <i class="fa
<?php echo $phone_entries [$key]['phone_type_select']; ?>"></i>
<a href="tel:<?php echo $phone_entries [$key]['emp_phone']; ?>" itemprop="telephone"><?php echo $phone_entries [$key]['emp_phone']; ?></a></div>
<?php
 }
?>
</div>
</div>
<?php
		if($emp_emails){
foreach ( $emp_emails as $email ) { ?>
<div class="cardemail"><i class="fa fa-envelope"></i><a href="mailto:<?php echo  $email; ?>" itemprop="email"><?php echo  $email; ?></a></div>
<?php
}
}
?>
</div>
</div>

<?php endif; // End single post check. ?>
