<?php
/**
 * @package Abraham
 */
?>

<div <?php hybrid_attr( 'entry-content' ); ?>>

<?php
	the_content();
	wp_link_pages();
?>

</div>
