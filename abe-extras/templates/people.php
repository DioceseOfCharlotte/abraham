<?php global $post;
		$first_name = get_post_meta( get_the_id(), '_doc_emp_first_name', true );
		$last_name = get_post_meta( get_the_id(), '_doc_emp_last_name', true );
?>

<?php
// Find connected pages
$connected = new WP_Query( array(
	'connected_type' => 'departments_to_people',
	'connected_items' => $post,
	'nopaging' => true,
) );
?>



<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

	<div class="card layout__item palm-1-1 sm-1-2 lg-1-3">
<div class="card--staff layout" itemscope itemtype="http://schema.org/Person">
<div class="layout__item card__avatar">
<?php get_the_image( array( 'size' => 'directory-thumbnail', 'image_class' => 'avatar', 'default_image' => get_stylesheet_directory_uri() . '/images/avatar-default.png' ) ); ?>
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

<?php wp_reset_postdata(); ?>

<?php endif; ?>

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

<div class="card card--staff layout layout__item all-1 md-1-2 ">

	<div class="comment-author layout__item md-3-24">
		<?php get_the_image( array( 'size' => 'directory-thumbnail', 'image_class' => 'avatar', 'default_image' => get_stylesheet_directory_uri() . '/images/avatar-default.png' ) ); ?>
	</div>
	<div class="layout layout__column layout__item md-21-24 flex-fit">
		<div class="Typography--title staff--detail staff--name">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

<?php if ( $connected->have_posts() ) :	?>

<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>

		<div class="Typography--subhead--colorContrast staff--detail staff--title">
			<?php echo p2p_get_meta( get_post()->p2p_id, 'job-title', true ); ?>
		</div>

<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php endif; ?>
	</div>

<?php //if ( is_user_logged_in() ) : ?>
	    <div class="dropdown-basic staff-meta Typography--textRight all-1" data-dropdown>

	    		<a class="info-btn info-btn__center strong" title="contact info" href="#">i</a>

        <div class="dropdown-menu-basic Typography--textLeft all-1" data-dropdown-menu>
            <ul>
                <li class="Typography--body-1 contact-info__list">
			    	<?php doc_phone(); ?>
			    </li>
			    <li class="Typography--body-1 contact-info__list">
			    	<?php doc_staff_email() ?>
			    </li>
            </ul>
        </div>
    </div>
<?php //endif; ?>

<?php if ( $connected->have_posts() ) :	?>

<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
		<a class="btn btn--small btn--full card__department all-1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php endif; ?>

</div>

		<?php endif; // End single post check. ?>
