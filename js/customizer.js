/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '#site-title, #site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '#site-title, #site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.home .site-header.is-top:not(.u-fixed) > *' ).css( {
					'color': to
				} );
				$( '.home .site-header:not(.is-top) > *' ).css( {
					'color': 'inherit!important'
				} );
			}
		} );
	} );

	// Theme Colors
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			$( '.u-bg-1' ).css( {
				'background-color': to
			} );
		} );
	} );
	wp.customize( 'secondary_color', function( value ) {
		value.bind( function( to ) {
			$( '.u-bg-2' ).css( {
				'background-color': to
			} );
		} );
	} );

} )( jQuery );
