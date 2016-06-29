<?php

add_action( 'wp_head', 'abe_add_google_analytics', 30 );

function abe_add_google_analytics() {
	if ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || current_user_can( 'manage_options' ) ) {
		return; }

	$ga_id = get_theme_mod( 'abe_analytics_id', '' );

	if ( '' !== $ga_id ) { ?>
			 <script>
				 window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
				 ga('create','<?php echo $ga_id; ?>','auto');ga('send','pageview');
			 </script>
			 <script src="https://www.google-analytics.com/analytics.js" async defer></script>
	<?php
	}
}
