/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hexToRgbA(hex, alpha) {
	var r = parseInt(hex.slice(1, 3), 16),
		g = parseInt(hex.slice(3, 5), 16),
		b = parseInt(hex.slice(5, 7), 16);

	if (alpha) {
		return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + alpha + ')';
	} else {
		return 'rgb(' + r + ', ' + g + ', ' + b + ')';
	}
}



(function($) {

	// Auxiliary method. Sets the value of a custom property at the document level.
	var setDocumentVariable = function(propertyName, value) {
		document.documentElement.style.setProperty(propertyName, value);
	};

	// Site title and description.
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('#site-title').text(to);
		});
	});
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('#site-description').text(to);
		});
	});

	// Header text color.
	wp.customize('header_textcolor', function(value) {
		value.bind(function(to) {
			if ('blank' === to) {
				$('#site-title, #site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('#site-title, #site-description').css({
					'clip': 'auto',
					'position': 'relative'
				});
				$('.home .site-header.is-top:not(.u-fixed) > *').css({
					'color': to
				});
				$('.home .site-header:not(.is-top) > *').css({
					'color': 'inherit!important'
				});
			}
		});
	});

	// Theme Colors
	wp.customize('primary_color', function(value) {
		value.bind(function(to) {
			setDocumentVariable('--color-1', to);
		});
	});
	wp.customize('secondary_color', function(value) {
		value.bind(function(to) {
			setDocumentVariable('--color-2', to);
		});
	});
	wp.customize('background_color', function(value) {
		value.bind(function(to) {
			setDocumentVariable('--site-bg', 'linear-gradient(to bottom,' + hexToRgbA(to, '.0') + '0, ' + hexToRgbA(to, '.3') + '40vh, ' + hexToRgbA(to, '.85') + '99vh, ' + hexToRgbA(to, '.99') + '100%)');
		});
	});

})(jQuery);
