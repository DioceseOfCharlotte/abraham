/**
 * main.js
 *
 *
 */

/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js */
if("document" in self){if(!("classList" in document.createElement("_"))){(function(j){"use strict";if(!("Element" in j)){return}var a="classList",f="prototype",m=j.Element[f],b=Object,k=String[f].trim||function(){return this.replace(/^\s+|\s+$/g,"")},c=Array[f].indexOf||function(q){var p=0,o=this.length;for(;p<o;p++){if(p in this&&this[p]===q){return p}}return -1},n=function(o,p){this.name=o;this.code=DOMException[o];this.message=p},g=function(p,o){if(o===""){throw new n("SYNTAX_ERR","An invalid or illegal string was specified")}if(/\s/.test(o)){throw new n("INVALID_CHARACTER_ERR","String contains an invalid character")}return c.call(p,o)},d=function(s){var r=k.call(s.getAttribute("class")||""),q=r?r.split(/\s+/):[],p=0,o=q.length;for(;p<o;p++){this.push(q[p])}this._updateClassName=function(){s.setAttribute("class",this.toString())}},e=d[f]=[],i=function(){return new d(this)};n[f]=Error[f];e.item=function(o){return this[o]||null};e.contains=function(o){o+="";return g(this,o)!==-1};e.add=function(){var s=arguments,r=0,p=s.length,q,o=false;do{q=s[r]+"";if(g(this,q)===-1){this.push(q);o=true}}while(++r<p);if(o){this._updateClassName()}};e.remove=function(){var t=arguments,s=0,p=t.length,r,o=false,q;do{r=t[s]+"";q=g(this,r);while(q!==-1){this.splice(q,1);o=true;q=g(this,r)}}while(++s<p);if(o){this._updateClassName()}};e.toggle=function(p,q){p+="";var o=this.contains(p),r=o?q!==true&&"remove":q!==false&&"add";if(r){this[r](p)}if(q===true||q===false){return q}else{return !o}};e.toString=function(){return this.join(" ")};if(b.defineProperty){var l={get:i,enumerable:true,configurable:true};try{b.defineProperty(m,a,l)}catch(h){if(h.number===-2146823252){l.enumerable=false;b.defineProperty(m,a,l)}}}else{if(b[f].__defineGetter__){m.__defineGetter__(a,i)}}}(self))}else{(function(){var b=document.createElement("_");b.classList.add("c1","c2");if(!b.classList.contains("c2")){var c=function(e){var d=DOMTokenList.prototype[e];DOMTokenList.prototype[e]=function(h){var g,f=arguments.length;for(g=0;g<f;g++){h=arguments[g];d.call(this,h)}}};c("add");c("remove")}b.classList.toggle("c3",false);if(b.classList.contains("c3")){var a=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(d,e){if(1 in arguments&&!this.contains(d)===!e){return e}else{return a.call(this,d)}}}b=null}())}};


/**
 * Drop v6.1.0
 * Simple, mobile-friendly dropdown menus, by Chris Ferdinandi.
 * http://github.com/cferdinandi/drop
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */

(function (root, factory) {
	if ( typeof define === 'function' && define.amd ) {
		define('drop', factory(root));
	} else if ( typeof exports === 'object' ) {
		module.exports = factory(root);
	} else {
		root.drop = factory(root);
	}
})(window || this, function (root) {

	'use strict';

	//
	// Variables
	//

	var drop = {}; // Object for public APIs
	var supports = !!document.querySelector && !!root.addEventListener; // Feature test
	var settings;

	// Default settings
	var defaults = {
		toggleActiveClass: 'active',
		contentActiveClass: 'active',
		initClass: 'js-drop',
		callbackBefore: function () {},
		callbackAfter: function () {}
	};


	//
	// Methods
	//

	/**
	 * A simple forEach() implementation for Arrays, Objects and NodeLists
	 * @private
	 * @param {Array|Object|NodeList} collection Collection of items to iterate
	 * @param {Function} callback Callback function for each iteration
	 * @param {Array|Object|NodeList} scope Object/NodeList/Array that forEach is iterating over (aka `this`)
	 */
	var forEach = function (collection, callback, scope) {
		if (Object.prototype.toString.call(collection) === '[object Object]') {
			for (var prop in collection) {
				if (Object.prototype.hasOwnProperty.call(collection, prop)) {
					callback.call(scope, collection[prop], prop, collection);
				}
			}
		} else {
			for (var i = 0, len = collection.length; i < len; i++) {
				callback.call(scope, collection[i], i, collection);
			}
		}
	};

	/**
	 * Merge defaults with user options
	 * @private
	 * @param {Object} defaults Default settings
	 * @param {Object} options User options
	 * @returns {Object} Merged values of defaults and options
	 */
	var extend = function ( defaults, options ) {
		var extended = {};
		forEach(defaults, function (value, prop) {
			extended[prop] = defaults[prop];
		});
		forEach(options, function (value, prop) {
			extended[prop] = options[prop];
		});
		return extended;
	};

	/**
	 * Get siblings of an element
	 * @private
	 * @param  {Element} elem
	 * @return {NodeList}
	 */
	var getSiblings = function (elem) {
		var siblings = [];
		var sibling = elem.parentNode.firstChild;
		for ( ; sibling; sibling = sibling.nextSibling ) {
			if ( sibling.nodeType == 1 && sibling != elem ) {
				siblings.push( sibling );
			}
		}
		return siblings;
	};

	/**
	 * Get closest DOM element up the tree that contains a class or data attribute
	 * @param  {Element} elem The base element
	 * @param  {String} selector The class or data attribute to look for
	 * @return {Boolean|Element} False if no match
	 */
	var getClosest = function (elem, selector) {

		var firstChar = selector.charAt(0);

		// Get closest match
		for ( ; elem && elem !== document; elem = elem.parentNode ) {
			if ( firstChar === '.' ) {
				if ( elem.classList.contains( selector.substr(1) ) ) {
					return elem;
				}
			} else if ( firstChar === '#' ) {
				if ( elem.id === selector.substr(1) ) {
					return elem;
				}
			} else if ( firstChar === '[' ) {
				if ( elem.hasAttribute( selector.substr(1, selector.length - 2) ) ) {
					return elem;
				}
			}
		}

		return null;

	};

	/**
	 * Toggle a dropdown menu
	 * @public
	 * @param  {Element} toggle Element that triggered the expand or collapse
	 * @param  {Object} settings
	 * @param  {Event} event
	 */
	drop.toggleDrop = function ( toggle, options, event ) {

		// Selectors and variables
		var settings = extend( settings || defaults, options || {} );  // Merge user options with defaults
		var toggleMenu = toggle.nextElementSibling;
		var toggleParent = toggle.parentNode;
		var toggleSiblings = getSiblings(toggleParent);

		settings.callbackBefore( toggle ); // Run callbacks before drop toggle

		// Add/remove '.active' class from dropdown item
		toggle.classList.toggle( settings.toggleActiveClass );
		toggleMenu.classList.toggle( settings.contentActiveClass );
		toggleParent.classList.toggle( settings.toggleActiveClass );

		// For each toggle, remove the active class
		forEach(toggleSiblings, function (sibling) {
			var siblingContent = sibling.children;
			sibling.classList.remove( settings.toggleActiveClass );
			forEach(siblingContent, function (content) {
				content.classList.remove( settings.contentActiveClass );
			});
		});

		settings.callbackAfter( toggle ); // Run callbacks after drop toggle

	};

	/**
	 * Close all dropdown menus
	 * @public
	 * @param  {Object} settings
	 */
	drop.closeDrops = function () {

		// Selectors and variables
		var dropToggle = document.querySelectorAll('.menu-item-has-children > a.' + settings.toggleActiveClass);
		var dropWrapper = document.querySelectorAll('.menu-item-has-children.' + settings.toggleActiveClass);
		var dropContent = document.querySelectorAll('.sub-menu.' + settings.contentActiveClass);

		if ( dropToggle.length > 0 || dropWrapper.length > 0 || dropContent.length > 0 ) {

			settings.callbackBefore(); // Run callbacks before drop close

			// For each dropdown toggle, remove '.active' class
			forEach(dropToggle, function (toggle) {
				toggle.classList.remove( settings.toggleActiveClass );
			});

			// For each dropdown toggle wrapper, remove '.active' class
			forEach(dropWrapper, function (wrapper) {
				wrapper.classList.remove( settings.toggleActiveClass );
			});

			// For each dropdown content area, remove '.active' class
			forEach(dropContent, function (content) {
				content.classList.remove( settings.contentActiveClass );
			});

			settings.callbackAfter(); // Run callbacks after drop close

		}

	};

	/**
	 * Handle toggle and document click events
	 * @private
	 */
	var eventHandler = function (event) {
		var toggle = event.target;
		var menu = getClosest(toggle, '.sub-menu');
		if ( menu && toggle !== document.documentElement && !toggle.parentNode.classList.contains( 'menu-item-has-children' ) ) {
			// If dropdown menu, do nothing
			return;
		} else if ( toggle !== document.documentElement && toggle.parentNode.classList.contains( 'menu-item-has-children' ) ) {
			// If dropdown toggle element, toggle dropdown menu
			event.preventDefault();
			drop.toggleDrop(toggle, settings);
		} else {
			// If document body, close open dropdown menus
			drop.closeDrops();
		}
	};

	/**
	 * Destroy the current initialization.
	 * @public
	 */
	drop.destroy = function () {
		if ( !settings ) return;
		document.documentElement.classList.remove( settings.initClass );
		document.removeEventListener('click', eventHandler, false);
		drop.closeDrops();
		settings = null;
	};

	/**
	 * Initialize Drop
	 * @public
	 * @param {Object} options User settings
	 */
	drop.init = function ( options ) {

		// feature test
		if ( !supports ) return;

		// Destroy any existing initializations
		drop.destroy();

		// Selectors and variables
		settings = extend( defaults, options || {} ); // Merge user options with defaults

		// Add class to HTML element to activate conditional CSS
		document.documentElement.classList.add( settings.initClass );

		// Listen for all click events
		document.addEventListener('click', eventHandler, false);

	};


	//
	// Public APIs
	//

	return drop;

});

( function() {
	drop.init({
    toggleClass: 'menu-item-has-children',
    contentClass: 'sub-menu',
    	});
})();
