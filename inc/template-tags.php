<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Abraham
 */


if ( ! function_exists( 'abraham_loop_meta' ) ) :
/**
 * Loop Title and Description
 */
function abraham_loop_meta() { ?>

<div <?php hybrid_attr( 'loop-meta' ); ?>>

	<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>

	<?php if ( is_category() || is_tax() ) : ?>

		<?php hybrid_get_menu( 'sub-terms' ); ?>

	<?php endif; ?>

	<?php if ( ! is_paged() && $desc = hybrid_get_loop_description() ) : ?>

		<div <?php hybrid_attr( 'loop-description' ); ?>>
			<?php echo $desc; ?>
		</div><!-- .loop-description -->

	<?php endif; ?>

</div><!-- .loop-meta -->
<?php }
endif;


if ( ! function_exists( 'abraham_loop_nav' ) ) :

function abraham_loop_nav() {

	if ( is_singular( 'post' ) ) :
		the_post_navigation( array(
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr;', 'abraham' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous article:', 'abraham' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next article:', 'abraham' ) . '</span>
				<span class="post-title">%title</span>
				<span class="meta-nav" aria-hidden="true">' . __( '&rarr;', 'abraham' ) . '</span> ',
		) );



	elseif ( is_home() || is_archive() || is_search() ) :
		the_posts_pagination( array(
			'prev_text'          => __( '<', 'abraham' ),
			'next_text'          => __( '>', 'abraham' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'abraham' ) . ' </span>',
		) );
	endif; // End nav-loop.

}
endif;






if ( ! function_exists( 'abraham_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function abraham_entry_meta() {  ?>
	<div class="entry-byline">
	<span class="entry-format"><?php hybrid_post_format_link(); ?></span>
	<?php hybrid_post_author(); ?>
	<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
  <?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) );
		echo '</span>';
	} ?>
	</div>
	<?php
	edit_post_link( esc_html__( 'Edit', 'abraham' ), '<span class="edit-link">', '</span>' );
}
endif;


if ( ! function_exists( 'abraham_post_terms' ) ) :
/**
 * Loop Title and Description
 */
function abraham_post_terms() {
		hybrid_post_terms( array(
			'taxonomy'	=> 'category',
			'sep' 		=> ' ',
			'before' 	=> '<br />'
			) );
		hybrid_post_terms( array(
			'taxonomy' 	=> 'post_tag',
			'sep' 		=> ' ',
			'before' 	=> '<br />'
			) );
}
endif;
