<?php
/**
 * @package Abraham
 */
?>
<div class="entry-byline">

	<span class="entry-format"><?php abe_post_format_link(); ?></span>

	<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
	<?php hybrid_post_author(); ?>
</div>
<header class="entry-header">
	<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
</header>
