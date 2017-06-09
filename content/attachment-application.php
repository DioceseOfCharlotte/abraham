<?php
/**
 * Template used mostly for documents.
 *
 * @package abraham
 */

$doc_link = wp_get_attachment_url( get_the_id() );
$file = basename( get_attached_file( get_the_id() ) );
$filetype = wp_check_filetype( $file );
?>

<article <?php hybrid_attr( 'post' ); ?>>

	<div class="u-1of1 u-flex u-flex-jb">
		<a class="dl-link btn" href="<?php echo $doc_link ?>" download>Download document <svg xmlns="http://www.w3.org/2000/svg" width="1.4em" height="1.4em" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/><path fill="none" d="M0 0h24v24H0z"/></svg></a>

<?php if ( 'pdf' === $filetype['ext'] ) :  ?>

		<a class="new-tab-link btn" href="<?php echo $doc_link ?>" target="_blank" rel="noopener">View document in a new tab <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1.4em" height="1.4em"><path d="M19 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6v2H5v12h12v-6h2zM13 3v2h4.586l-7.793 7.793 1.414 1.414L19 6.414V11h2V3h-8z"/></svg></a>

<?php endif; ?>

	</div>

<?php if ( 'pdf' === $filetype['ext'] ) :  ?>

<object class="doc-embed" data="<?php echo $doc_link ?>#pagemode=bookmarks" type="application/pdf" width="100%" height="600px">
	<iframe src="https://docs.google.com/viewer?url=<?php echo $doc_link ?>&amp;hl=en_US&amp;embedded=true" width="100%" height="600px" style="border: none;">
		This browser does not support PDFs. Please download the PDF to view it:
	</iframe>
</object>

<?php else : ?>

	<iframe src="https://docs.google.com/viewer?url=<?php echo $doc_link ?>&amp;hl=en_US&amp;embedded=true" width="100%" height="600px" style="border: none;"></iframe>

<?php endif; ?>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>
