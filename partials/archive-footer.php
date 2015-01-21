<?php
/**
 * @package Abraham
 */
?>

<span class="entry-format"><?php abe_post_format_link(); ?></span>

<?php
if ( ! is_single() && ! post_password_required() && ( comments_open() && get_comments_number() ) ) { ?>

<footer class="entry-footer">
	<div class="comments-number">
		<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
	</div>
</footer>

<?php
}
