<?php global $post;
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

	<div class="card layout__item palm-1-1 sm-1-2 lg-1-3">
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

<?php doc_phone(); ?>

</div>


</div>
<?php doc_staff_email() ?>
</div>
</div>
</div><!-- .card -->

<?php else : // If not viewing a single post. ?>

<div class="card layout layout__item all-1 md-1-2 ">

<div class="comment-author layout__item md-3-24">
		<?php get_the_image( array( 'size' => 'directory-thumbnail', 'image_class' => 'avatar', 'default_image' => get_stylesheet_directory_uri() . '/images/avatar-default.png' ) ); ?>
</div>
	<div class="md-21-24 card__details layout__item layout layout__column">
		<header class="card-header all-1-1">
			<?php the_title( '<a href="' . get_permalink() . '">', '</a>' ); ?>
		</header><!-- .card-header -->

		<div class="layout layout__item middle--info">
			<div class="card__titles layout__item">

				<?php if ( $connected->have_posts() ) :	?>
					<div class="card__department">

						<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
							<div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div><?php echo  p2p_get_meta( get_post()->p2p_id, 'role', true ); ?></div>
						<?php endwhile; ?>

					</div>

	<?php wp_reset_postdata(); ?>

				<?php endif; ?>

			</div>

			<div class="card__phone-list layout__item">
					<div class="card__phone">
						<?php doc_phone(); ?>
					</div>
			</div>

		</div>

		<?php doc_staff_email() ?>

	</div>
</div>

	<?php wp_reset_postdata(); ?>

		<?php endif; // End single post check. ?>
