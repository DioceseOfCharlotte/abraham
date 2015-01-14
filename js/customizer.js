/**
 * Function for turning a hex color into an RGB string.
 */
function scratch_hex_to_rgb( hex ) {
	var color = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );

	return parseInt( color[1], 16 ) + ", " + parseInt( color[2], 16 ) + ", " + parseInt( color[3], 16 );
}

/**
 * Handles the customizer live preview settings.
 */
jQuery( document ).ready( function() {

	/*
	 * Shows a live preview of changing the site title.
	 */
	wp.customize( 'blogname', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-title a' ).html( to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Handles the header textcolor.  This code also accounts for the possibility that the header text color
	 * may be set to 'blank', in which case, any text in the header is hidden.
	 */
	wp.customize( 'header_textcolor', function( value ) {

		value.bind( function( to ) {

			/* If set to 'blank', hide the branding section and secondary menu. */
			if ( 'blank' === to ) {

				/* Hides branding and menu-secondary. */
				jQuery( '#branding' ).css( 'display', 'none' );

				/* Removes the 'display-header-text' <body> class. */
				jQuery( 'body' ).removeClass( 'display-header-text' );
			}

			/* Change the header and secondary menu colors. */
			else {

				/* Adds the 'display-header-text' <body> class. */
				jQuery( 'body' ).addClass( 'display-header-text' );

				/* Makes sures both branding and menu-secondary display. */
				jQuery( '#branding' ).css( 'display', 'block' );

				var rgb = scratch_hex_to_rgb( to );

				/* Changes the color of the site title link. */
				jQuery( '#site-title, #site-title a, #footer a' ).css( 'color', to );

				jQuery( '#site-description, #footer' ).css( 'color', 'rgba( ' + rgb + ', 0.75 )' );

			} // endif

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Handes the header image.  This code replaces the "src" attribute for the image.
	 */
	wp.customize( 'header_image', function( value ) {

		value.bind( function( to ) {

			/* If removing the header image, make sure to hide it so there's not an error image. */
			if ( 'remove-header' === to ) {
				jQuery( '.header-image' ).hide();
			}

			/* Else, make sure to show the image and change the source. */
			else {
				jQuery( '.header-image' ).show();
				jQuery( '.header-image' ).attr( 'src', to );
			}

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Shows a live preview of changing the site description.
	 */
	wp.customize( 'blogdescription', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-description' ).html( to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Handles the Primary color for the theme.  This color is used for various elements and at different
	 * shades. It must set an rgba color value to handle the "shades".
	 */
	wp.customize( 'color_primary', function( value ) {

		value.bind( function( to ) {

			var rgb = scratch_hex_to_rgb( to );

			/* special case: hover */

			jQuery( '.mejs-button button' ).
				hover(
					function() {
						jQuery( this ).css( 'color', to );
						jQuery( this ).children( '.entry-subtitle' ).css( 'color', to );

					},
					function() {
						jQuery( this ).css( 'color', 'inherit' );
						jQuery( this ).children( '.entry-subtitle' ).css( 'color', 'inherit' );
					}
			); // .hover

			jQuery( '.wp-playlist-light .wp-playlist-item, .mejs-overlay-button' ).
				hover(
					function() {
						jQuery( this ).css( 'color', to );

					},
					function() {
						jQuery( this ).css( 'color', 'rgba( ' + rgb + ', 0.75 )' );
					}
			); // .hover

			jQuery( "input[type='submit'], input[type='reset'], input[type='button'], button, .comment-reply-link" ).
				not( '.menu-toggle button, .mejs-button button' ).
				hover(
					function() {
						jQuery( this ).css( 'background-color', to );

					},
					function() {
						jQuery( this ).css( 'background-color', 'rgba( ' + rgb + ', 0.75 )' );
					}
			); // .hover

			/* color */

			jQuery( 'label.focus, legend, pre, .form-allowed-tags code, .required, .line-through' ).
				css( 'color', to );

			jQuery( '.mejs-overlay-button' ).
				css( 'color', 'rgba( ' + rgb + ', 0.75 )' );

			/* background color */

			jQuery( '.mejs-time-rail .mejs-time-loaded' ).
				css( 'background-color', to );

			jQuery( "input[type='submit'], input[type='reset'], input[type='button'], button, .comment-reply-link" ).
				not( '.menu-toggle button, .mejs-button button' ).
				css( 'background-color', 'rgba( ' + rgb + ', 0.75 )' );

			jQuery( '.site-header, .site-branding, legend, pre, .form-allowed-tags code' ).
				css( 'background-color', 'rgba( ' + rgb + ', 0.1 )' );

			/* border color */

			jQuery( 'legend, pre, .form-allowed-tags code' ).
				css( 'border-color', 'rgba( ' + rgb + ', 0.15 )' );

			/* border bottom color */

			jQuery( 'ins, u' ).
				css( 'border-bottom-color', to );

			jQuery( 'blockquote.alignright, blockquote.alignleft, blockquote.aligncenter' ).
				css( 'border-bottom-color', 'rgba( ' + rgb + ', 0.25 )' );

			/* border top color */

			jQuery( '.format-chat .chat-author' ).
				css( 'border-top-color', 'rgba( ' + rgb + ', 0.25 )' );

		} ); // value.bind

	} ); // wp.customize

} ); // jQuery( document ).ready
