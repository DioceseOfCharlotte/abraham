<?php
/**
 * @package Abraham
 */
?>

<header <?php hybrid_attr( 'loop-meta' ); ?>>

<?php
	if (is_archive() ) : ?>
		<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php the_archive_title(); ?></h1>
<?php
	elseif (is_search() ) :
		get_search_form(); ?>
		<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php printf( __( 'Search Results for %s', 'abraham' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
<?php
	elseif (is_404() ) : ?>
    	<h1 class="nothing-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'abraham' ); ?></h1>
<?php
	endif; ?>

</header><!-- .loop-meta -->
