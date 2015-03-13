<?php
/**
 * @package Abraham
 */

the_post_navigation( [
	'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next &rarr;', 'abraham' ) . '</span> ' .
		'<span class="screen-reader-text">' . __( 'Next post:', 'abraham' ) . '</span> ' .
		'<span class="post-title">%title</span>',
	'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr; Previous', 'abraham' ) . '</span> ' .
		'<span class="screen-reader-text">' . __( 'Previous post:', 'abraham' ) . '</span> ' .
		'<span class="post-title">%title</span>',
] );
