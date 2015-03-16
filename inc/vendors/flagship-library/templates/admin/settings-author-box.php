<?php
/**
 * A template part for the author box settings on the user profile screens.
 *
 * @package     FlagshipLibrary
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015, Flagship Software, LLC
 * @license     GPL-2.0+
 * @link        https://flagshipwp.com/
 * @since       1.4.0
 */
?>
<h3><?php _e( 'Author Box Settings', 'flagship-library' ); ?></h3>

<p><span class="description"><?php _e( 'Choose where you would like to display an author box.', 'flagship-library' ); ?></span></p>

<table class="form-table">
	<tbody>
		<tr>
			<td>
				<label for="meta[flagship_author_box_single]">
					<input id="meta[flagship_author_box_single]" name="meta[flagship_author_box_single]" type="checkbox" value="1" <?php checked( $single_box ); ?> />
					<?php _e( 'Enable Author Box on this User\'s Posts?', 'flagship-library' ); ?>
				</label><br />

				<label for="meta[flagship_author_box_archive]">
					<input id="meta[flagship_author_box_archive]" name="meta[flagship_author_box_archive]" type="checkbox" value="1" <?php checked( $archive_box ); ?> />
					<?php _e( 'Enable Author Box on this User\'s Archives?', 'flagship-library' ); ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>
