<?php
/**
 * @package Abraham
 */
?>

<div <?php hybrid_attr( 'entry-summary' ); ?>>

<?php
	if ( ! post_password_required() ) {
		the_excerpt();
	}
?>

</div>
