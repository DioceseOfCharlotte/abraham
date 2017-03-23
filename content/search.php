<?php
/**
 * Search results template.
 *
 * @package abraham
 */
$obj = get_post_type_object( get_post_type() );

$parent_post = wp_get_post_parent_id( get_the_ID() );
if ( $parent_post > 0 ) {
	$parent_crumb = get_the_title( $parent_post );
} else {
	$parent_crumb = $obj->labels->name;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="flag-body u-inline-block u-flexed-1">

		<h2 class="u-h4 u-m0 u-p0">
			<a class="u-1of1 u-link u-shadow0 u-inline-block u-p1 u-pb05" href="<?php the_permalink(); ?>">
				<div class="u-h6 u-mb05 u-italic u-opacity"><?php echo $parent_crumb; ?>&nbsp;<?php abe_do_svg( 'chevron-right', 'sm' ) ?></div>
				<?php the_title(); ?>
			</a>

		</h2>

<?php if ( has_excerpt() || hybrid_post_has_content() ) { ?>
		<div class="entry-summary u-p1 u-pt0 u-h6">
			<?php the_excerpt(); ?>
		</div>
<?php } ?>

	</div>

	<div class="u-p05 u-inline-block">
		<?php the_post_thumbnail(); ?>
	</div>
<?php abe_edit_link() ?>
</article>
