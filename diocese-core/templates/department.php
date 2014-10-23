<?php global $post;
	$phone_entries = get_post_meta( get_the_ID(), 'phone_group', true );
	$first_name = get_post_meta( get_the_ID(), '_doc_emp_first_name', true );
	$last_name = get_post_meta( get_the_ID(), '_doc_emp_last_name', true );
	$emp_emails = get_post_meta( get_the_ID(), '_doc_emp_email', true );
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

 <?php get_the_image( array( 'size' => 'large' ) ); ?>

<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

<footer class="entry-footer">

		<?php
// Display connected pages
if ( $connected->have_posts() ) :
?>
<div class="card__department">
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>

<div class="card--staff layout shadow-z1" itemscope itemtype="http://schema.org/Person">
<div class="layout__item card__avatar">
<?php get_the_image( array( 'size' => 'directory-thumbnail' ) ); ?>
</div>
<div class="card__details layout__item layout layout__column">
		<div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<div><?php echo  p2p_get_meta( get_post()->p2p_id, 'role', true ); ?></div>
		<div><?php echo get_post_meta( get_the_ID(), '_doc_emp_first_name', true ); ?></div>
<div class="card__phone-list layout__item">
	<?php
		foreach ( $phone_entries as $key => $phone_entries ) {
?>
<div class="card__phone">
<a href="tel:<?php echo $phone_entries [$key]['emp_phone']; ?>" itemprop="telephone"><i class="fa
<?php echo $phone_entries [$key]['phone_type_select']; ?>"></i> <?php echo $phone_entries [$key]['emp_phone']; ?></a></div>
<?php
 }
?>
</div>
</div>

<?php
		if($emp_emails){
foreach ( $emp_emails as $email ) { ?>
<div class="cardemail"><a href="mailto:<?php echo  $email; ?>" itemprop="email"><i class="fa fa-envelope"></i> <?php echo  $email; ?></a></div>
<?php
}
}
?>
</div>
<?php  endwhile; ?>
</div>
<?php
wp_reset_postdata();
endif;
?>

	<?php global $post;
		$doc_uploads = get_post_meta( get_the_ID(), '_doc_document_group', true );
?>
<?php
// Find connected pages
$connected = new WP_Query( array(
	'connected_type' => 'departments_to_documents',
	'connected_items' => $post,
	'nopaging' => true,
) );
?>


	<?php
// Display connected pages
if ( $connected->have_posts() ) :
?>
<div class="card__department">
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>


<div class="card__doc-list layout__item">
	<?php
		foreach ( $doc_uploads as $key => $doc_upload ) {
?>
<div class="card__doc">
<a href="<?php echo $doc_uploads [$key]['doc_file']; ?>"><?php the_title(); ?></a>
</div>
<?php
 }
?>
<?php  endwhile; ?>
</div>
<?php
wp_reset_postdata();
endif;
?>

		</footer><!-- .entry-footer -->



	<?php else : // If not viewing a single post. ?>

		<?php get_the_image(); ?>



	<?php endif; // End single post check. ?>
