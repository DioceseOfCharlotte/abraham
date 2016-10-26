<?php
/**
 * Post Children.
 *
 * @package  RCDOC
 */

$args = array(
	'post_parent'            => get_the_ID(),
	'post_type'              => 'any',
	'order'                  => 'ASC',
	'orderby'                => 'menu_order',
);

$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$query = new WP_Query( $args );

// Pagination fix.
$temp_query = $wp_query;
$wp_query   = null;
$wp_query   = $query;

if ( $query->have_posts() ) : ?>

	<div class="o-cell o-grid u-m0 u-p0 u-1of1">

		<?php
		while ( $query->have_posts() ) : $query->the_post();

			hybrid_get_content_template();

		endwhile;
		?>

	</div>

<?php endif;

wp_reset_postdata();

// Custom query loop pagination.
previous_posts_link( 'Older Posts' );
next_posts_link( 'Newer Posts', $query->max_num_pages );

// Reset main query object.
$wp_query = null;
$wp_query = $temp_query;
