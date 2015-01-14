<?php if ( ! is_home() && ! is_archive() && ! is_search() ) {
			return;
}

		the_posts_pagination( array(
			'prev_text'          => __( ' ', 'abraham' ),
			'next_text'          => __( ' ', 'abraham' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'abraham' ) . ' </span>',
		) );
