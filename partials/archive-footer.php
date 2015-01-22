<?php
/**
 * @package Abraham
 */

if ( ! has_post_format() && ( ! get_comments_number() || post_password_required() ) )
	return;
?>

<footer class="entry-footer">

<?php
if ( has_post_format() ) :

hybrid_post_format_link();

endif;

if ( ! post_password_required() && get_comments_number() ) { ?>

	<div class="comments-number">
		<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
	</div>

<?php
}
?>
</footer>
