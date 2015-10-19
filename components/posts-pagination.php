<?php
the_posts_pagination( array(
    'next_text' =>  '<span class="meta-nav mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored" aria-hidden="true"><i class="material-icons">&#xE409;</i></span> ',
    'prev_text' => '<span class="meta-nav mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored" aria-hidden="true"><i class="material-icons">&#xE408;</i></span> ',
    'before_page_number' => '<span class="u-text-white meta-nav screen-reader-text">' . __( 'Page', 'abraham' ) . ' </span>',
) );
?>
