<article <?php hybrid_attr( 'post' ); ?>>

    <?php if ( is_singular( get_post_type() ) ) : ?>

        <header class="entry-header">
            <h1 <?php hybrid_attr( 'entry-title' ); ?>>
            	<?php single_post_title(); ?>
            </h1>
        </header><!-- .entry-header -->

        <div <?php hybrid_attr( 'entry-content' ); ?>>
        	<?php get_the_image(); ?>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">

<?php
	$connected = new WP_Query( array(
	  'connected_type' => 'departments_to_employees',
	  'connected_items' => get_queried_object(),
	  'nopaging' => true,
	) );
?>

<?php if ( $connected->have_posts() ) : ?>

	<h5>Staff:</h5>
	<ul class="staff-info">

<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>

	    <li class="Typography--subhead">
	    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	    </li>
	    <li class="Typography--body-2">
	    	<?php doc_phone(); ?>
	    </li>
	    <li class="Typography--body-2">
	    	<?php doc_staff_email() ?>
	    </li>

	<?php endwhile; ?>
	</ul>

<?php
// Prevent weirdness
wp_reset_postdata();

endif;
?>

<?php
$connected = new WP_Query( array(
  'connected_type' => 'departments_to_documents',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

if ( $connected->have_posts() ) :
?>
<h5>Related documents:</h5>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li class="Typography--subhead">
    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </li>
<?php endwhile; ?>
</ul>

<?php
// Prevent weirdness
wp_reset_postdata();

endif;
?>

        </footer><!-- .entry-footer -->











    <?php else : // If not viewing a single post. ?>

        <?php get_the_image(); ?>

        <header class="entry-header">

            <?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '">', '</a></h2>' ); ?>

        </header><!-- .entry-header -->

        <div <?php hybrid_attr( 'entry-summary' ); ?>>

        </div><!-- .entry-summary -->

    <?php endif; // End single post check. ?>

</article><!-- .entry -->
