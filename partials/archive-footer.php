<?php
/**
 * @package Abraham
 */
?>

<footer class="entry-footer">

	  	<?php if ( ! is_single() && ! post_password_required() && ( comments_open() && get_comments_number() ) ) {

		comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' );
	} ?>

</footer>
