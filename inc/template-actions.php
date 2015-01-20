<?php

// add_action( 'tha_entry_before', 'abraham_do_format_icon' );


add_action( 'tha_entry_top', 'abraham_do_byline' );




function abraham_do_format_icon() {

	abraham_post_format_link(); ?>
	<span class="format-icon--wrap"><?php abraham_format_svg(); ?></span>
	</span></a>
	<?php
}


function abraham_do_byline() {

if ( is_category( 'development' ) ) : ?>
	<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
	<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
<?php
endif;
}
