<?php

// add_action( 'tha_entry_before', 'scratch_do_format_icon' );







function scratch_do_format_icon() {

	scratch_post_format_link(); ?>
	<span class="format-icon--wrap"><?php scratch_format_svg(); ?></span>
	</span></a>
	<?php
}
