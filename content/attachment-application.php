<?php
/**
 * Template used mostly for documents.
 *
 * @package abraham
 */

?>
<?php $doc_link = wp_get_attachment_url( get_the_id() ); ?>

<article <?php hybrid_attr( 'post' ); ?>>

		<object class="doc-embed" data="<?php echo $doc_link ?>#pagemode=bookmarks" type="application/pdf" width="100%" height="600px">
			<iframe src="https://docs.google.com/viewer?url=<?php echo $doc_link ?>&amp;hl=en_US&amp;embedded=true" width="100%" height="600px" style="border: none;">
				This browser does not support PDFs. Please download the PDF to view it:
			</iframe>
		</object>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

</article>
