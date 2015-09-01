/*
 * classList.js: Cross-browser full element.classList implementation.
 * 1.1.20150312
 *
 * By Eli Grey, http://eligrey.com
 * License: Dedicated to the public domain.
 *   See https://github.com/eligrey/classList.js/blob/master/LICENSE.md
 */

/*global self, document, DOMException */

/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js */

if ("document" in self) {

// Full polyfill for browsers with no classList support
if (!("classList" in document.createElement("_"))) {

(function (view) {

"use strict";

if (!('Element' in view)) return;

var
	  classListProp = "classList"
	, protoProp = "prototype"
	, elemCtrProto = view.Element[protoProp]
	, objCtr = Object
	, strTrim = String[protoProp].trim || function () {
		return this.replace(/^\s+|\s+$/g, "");
	}
	, arrIndexOf = Array[protoProp].indexOf || function (item) {
		var
			  i = 0
			, len = this.length
		;
		for (; i < len; i++) {
			if (i in this && this[i] === item) {
				return i;
			}
		}
		return -1;
	}
	// Vendors: please allow content code to instantiate DOMExceptions
	, DOMEx = function (type, message) {
		this.name = type;
		this.code = DOMException[type];
		this.message = message;
	}
	, checkTokenAndGetIndex = function (classList, token) {
		if (token === "") {
			throw new DOMEx(
				  "SYNTAX_ERR"
				, "An invalid or illegal string was specified"
			);
		}
		if (/\s/.test(token)) {
			throw new DOMEx(
				  "INVALID_CHARACTER_ERR"
				, "String contains an invalid character"
			);
		}
		return arrIndexOf.call(classList, token);
	}
	, ClassList = function (elem) {
		var
			  trimmedClasses = strTrim.call(elem.getAttribute("class") || "")
			, classes = trimmedClasses ? trimmedClasses.split(/\s+/) : []
			, i = 0
			, len = classes.length
		;
		for (; i < len; i++) {
			this.push(classes[i]);
		}
		this._updateClassName = function () {
			elem.setAttribute("class", this.toString());
		};
	}
	, classListProto = ClassList[protoProp] = []
	, classListGetter = function () {
		return new ClassList(this);
	}
;
// Most DOMException implementations don't allow calling DOMException's toString()
// on non-DOMExceptions. Error's toString() is sufficient here.
DOMEx[protoProp] = Error[protoProp];
classListProto.item = function (i) {
	return this[i] || null;
};
classListProto.contains = function (token) {
	token += "";
	return checkTokenAndGetIndex(this, token) !== -1;
};
classListProto.add = function () {
	var
		  tokens = arguments
		, i = 0
		, l = tokens.length
		, token
		, updated = false
	;
	do {
		token = tokens[i] + "";
		if (checkTokenAndGetIndex(this, token) === -1) {
			this.push(token);
			updated = true;
		}
	}
	while (++i < l);

	if (updated) {
		this._updateClassName();
	}
};
classListProto.remove = function () {
	var
		  tokens = arguments
		, i = 0
		, l = tokens.length
		, token
		, updated = false
		, index
	;
	do {
		token = tokens[i] + "";
		index = checkTokenAndGetIndex(this, token);
		while (index !== -1) {
			this.splice(index, 1);
			updated = true;
			index = checkTokenAndGetIndex(this, token);
		}
	}
	while (++i < l);

	if (updated) {
		this._updateClassName();
	}
};
classListProto.toggle = function (token, force) {
	token += "";

	var
		  result = this.contains(token)
		, method = result ?
			force !== true && "remove"
		:
			force !== false && "add"
	;

	if (method) {
		this[method](token);
	}

	if (force === true || force === false) {
		return force;
	} else {
		return !result;
	}
};
classListProto.toString = function () {
	return this.join(" ");
};

if (objCtr.defineProperty) {
	var classListPropDesc = {
		  get: classListGetter
		, enumerable: true
		, configurable: true
	};
	try {
		objCtr.defineProperty(elemCtrProto, classListProp, classListPropDesc);
	} catch (ex) { // IE 8 doesn't support enumerable:true
		if (ex.number === -0x7FF5EC54) {
			classListPropDesc.enumerable = false;
			objCtr.defineProperty(elemCtrProto, classListProp, classListPropDesc);
		}
	}
} else if (objCtr[protoProp].__defineGetter__) {
	elemCtrProto.__defineGetter__(classListProp, classListGetter);
}

}(self));

} else {
// There is full or partial native classList support, so just check if we need
// to normalize the add/remove and toggle APIs.

(function () {
	"use strict";

	var testElement = document.createElement("_");

	testElement.classList.add("c1", "c2");

	// Polyfill for IE 10/11 and Firefox <26, where classList.add and
	// classList.remove exist but support only one argument at a time.
	if (!testElement.classList.contains("c2")) {
		var createMethod = function(method) {
			var original = DOMTokenList.prototype[method];

			DOMTokenList.prototype[method] = function(token) {
				var i, len = arguments.length;

				for (i = 0; i < len; i++) {
					token = arguments[i];
					original.call(this, token);
				}
			};
		};
		createMethod('add');
		createMethod('remove');
	}

	testElement.classList.toggle("c3", false);

	// Polyfill for IE 10 and Firefox <24, where classList.toggle does not
	// support the second argument.
	if (testElement.classList.contains("c3")) {
		var _toggle = DOMTokenList.prototype.toggle;

		DOMTokenList.prototype.toggle = function(token, force) {
			if (1 in arguments && !this.contains(token) === !force) {
				return force;
			} else {
				return _toggle.call(this, token);
			}
		};

	}

	testElement = null;
}());

}

}


function DropPanel(element) {
    'use strict';
    this.element_ = element;
    this.init();
    document.getElementById("user_login").placeholder = "Username or Email";
    document.getElementById("user_pass").placeholder = "Password";
}

DropPanel.prototype.init = function() {
    "use strict";
    this.boundClickHandler = this.clickHandler.bind(this);
    this.element_.addEventListener('click', this.boundClickHandler);
};


DropPanel.prototype.clickHandler = function(event) {
    "use strict";
    var target = event.target;
    if( ! target.classList.contains(this.CssClasses_.PANEL_IS_ACTIVE)){
        target.classList.add(this.CssClasses_.PANEL_IS_ACTIVE);
        target.previousElementSibling.classList.add(this.CssClasses_.PANEL_IS_VISIBLE);
    } else {
        target.previousElementSibling.classList.remove(this.CssClasses_.PANEL_IS_VISIBLE);
        target.classList.remove(this.CssClasses_.PANEL_IS_ACTIVE);
    }
};


DropPanel.prototype.CssClasses_ = {
    PANEL_IS_ACTIVE: 'is-active',
    PANEL_IS_VISIBLE: 'is-visible'
};

DropPanel.prototype.mdlDowngrade_ = function() {
  'use strict';
  this.element_.removeEventListener('click', this.boundClickHandler);
};

componentHandler.register({
    constructor: DropPanel,
    classAsString: 'DropPanel',
    cssClass: 'js-drop-panel'
});

/**
 * Drop v6.1.4
 * Simple, mobile-friendly dropdown menus, by Chris Ferdinandi.
 * http://github.com/cferdinandi/drop
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */

(function (root, factory) {
	if ( typeof define === 'function' && define.amd ) {
		define([], factory(root));
	} else if ( typeof exports === 'object' ) {
		module.exports = factory(root);
	} else {
		root.drop = factory(root);
	}
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {

	'use strict';

	//
	// Variables
	//

	var drop = {}; // Object for public APIs
	var supports = !!document.querySelector && !!root.addEventListener; // Feature test
	var settings;

	// Default settings
	var defaults = {
		toggleActiveClass: 'is-active',
		contentActiveClass: 'is-active',
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
		var dropToggle = document.querySelectorAll('.js-dropdown > a.' + settings.toggleActiveClass);
		var dropWrapper = document.querySelectorAll('.js-dropdown.' + settings.toggleActiveClass);
		var dropContent = document.querySelectorAll('.dropdown.' + settings.contentActiveClass);

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
			 var menu = getClosest(toggle, '.dropdown');
			 if ( menu && toggle !== document.documentElement && !toggle.parentNode.classList.contains( 'js-dropdown' ) ) {
					 // If dropdown menu, do nothing
					 return;
			 } else if ( toggle !== document.documentElement && toggle.parentNode.classList.contains( 'js-dropdown' ) ) {
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
    drop.init();
})();

// Open the first Tab by default.
var ready = function ( fn ) {

    // Sanity check
    if ( typeof fn !== 'function' ) return;

    // If document is already loaded, run method
    if ( document.readyState === 'complete'  ) {
        return fn();
    }

    // Otherwise, wait until document is loaded
    document.addEventListener( 'DOMContentLoaded', fn, false );

};

// Example
ready(function() {
  var first_tab = document.getElementsByClassName("mdl-tabs__tab")[0];
  var first_panel = document.getElementsByClassName("mdl-tabs__panel")[0];
    first_tab.classList.toggle("is-active");
    first_panel.classList.toggle("is-active");
});

/**
 * Tabby v7.4.6
 * Simple, mobile-first toggle tabs., by Chris Ferdinandi.
 * http://github.com/cferdinandi/tabby
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */

(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.tabby = factory(root);
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {

  'use strict';

  //
  // Variables
  //

  var tabby = {}; // Object for public APIs
  var supports = !!document.querySelector && !!root.addEventListener; // Feature test
  var settings;

  // Default settings
  var defaults = {
    toggleActiveClass: 'is-active',
    contentActiveClass: 'is-active',
    initClass: 'js-tabby',
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
   * Get the closest matching element up the DOM tree
   * @param {Element} elem Starting element
   * @param {String} selector Selector to match against (class, ID, or data attribute)
   * @return {Boolean|Element} Returns false if not match found
   */
  var getClosest = function (elem, selector) {
    var firstChar = selector.charAt(0);
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
    return false;
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
    var skipMe = elem;
    for ( ; sibling; sibling = sibling.nextSibling ) {
      if ( sibling.nodeType == 1 && sibling != elem ) {
        siblings.push( sibling );
      }
    }
    return siblings;
  };

  /**
   * Stop YouTube, Vimeo, and HTML5 videos from playing when leaving the slide
   * @private
   * @param  {Element} content The content container the video is in
   * @param  {String} activeClass The class asigned to expanded content areas
   */
  var stopVideos = function ( content, activeClass ) {
    if ( !content.classList.contains( activeClass ) ) {
      var iframe = content.querySelector( 'iframe');
      var video = content.querySelector( 'video' );
      if ( iframe ) {
        var iframeSrc = iframe.src;
        iframe.src = iframeSrc;
      }
      if ( video ) {
        video.pause();
      }
    }
  };

  /**
   * Hide all other tabs and content
   * @param  {Element} toggle The element that toggled the tab content
   * @param  {Element} tab The tab to show
   * @param  {Object} settings
   */
  var hideOtherTabs = function ( toggle, tab, settings ) {

    // Variables
    var isLinkList = toggle.parentNode.tagName.toLowerCase() === 'li' ? true : false;
    var toggleSiblings = isLinkList ? getSiblings(toggle.parentNode) : getSiblings(toggle);
    var tabSiblings = getSiblings(tab);

    // Hide toggles
    forEach(toggleSiblings, function (sibling) {
      sibling.classList.remove( settings.toggleActiveClass );
      if ( isLinkList ) {
        sibling.querySelector('[data-tab]').classList.remove( settings.toggleActiveClass );
      }
    });

    // Hide tabs
    forEach(tabSiblings, function (tab) {
      if ( tab.classList.contains( settings.contentActiveClass ) ) {
        stopVideos(tab);
        tab.classList.remove( settings.contentActiveClass );
      }
    });

  };

  /**
   * Show target tabs
   * @private
   * @param  {NodeList} tabs A nodelist of tabs to close
   * @param  {Object} settings
   */
  // var showTargetTabs = function ( tabs, settings ) {
  var showTargetTabs = function ( toggle, tabs, settings ) {
    var toggleParent = toggle.parentNode;
    toggle.classList.add( settings.toggleActiveClass );
    if ( toggleParent && toggleParent.tagName.toLowerCase() === 'li' ) {
      toggleParent.classList.add( settings.toggleActiveClass );
    }
    forEach(tabs, function (tab) {
      tab.classList.add( settings.contentActiveClass );
    });
  };

  /**
   * Show a tab and hide all others
   * @public
   * @param  {Element} toggle The element that toggled the show tab event
   * @param  {String} tabID The ID of the tab to show
   * @param  {Object} options
   * @param  {Event} event
   */
  tabby.toggleTab = function ( toggle, tabID, options, event ) {

    // Selectors and variables
    var settings = extend( settings || defaults, options || {} );  // Merge user options with defaults
    var tabs = document.querySelectorAll(tabID); // Get tab content

    settings.callbackBefore( toggle, tabID ); // Run callbacks before toggling tab

    // Set clicked toggle to active. Deactivate others.
    hideOtherTabs( toggle, tabs[0], settings );
    showTargetTabs( toggle, tabs, settings );

    settings.callbackAfter( toggle, tabID ); // Run callbacks after toggling tab

  };

  /**
   * Handle toggle click events
   * @private
   */
  var eventHandler = function (event) {
    var toggle = getClosest(event.target, '[data-tab]');
    if ( toggle ) {
      event.preventDefault();
      tabby.toggleTab(toggle, toggle.getAttribute('data-tab'), settings);
    }
  };

  /**
   * Destroy the current initialization.
   * @public
   */
  tabby.destroy = function () {
    if ( !settings ) return;
    document.documentElement.classList.remove( settings.initClass );
    document.removeEventListener('click', eventHandler, false);
    settings = null;
  };

  /**
   * Initialize Tabby
   * @public
   * @param {Object} options User settings
   */
  tabby.init = function ( options ) {

    // feature test
    if ( !supports ) return;

    // Destroy any existing initializations
    tabby.destroy();

    // Merge user options with defaults
    settings = extend( defaults, options || {} );

    // Add class to HTML element to activate conditional CSS
    document.documentElement.classList.add( settings.initClass );

    // Listen for all click events
    document.addEventListener('click', eventHandler, false);

  };


  //
  // Public APIs
  //

  return tabby;

});

var toggle = document.querySelector('[data-tab="#tab156"]');
tabby.toggleTab( toggle, '#tab156' );


tabby.init();

/**
 * Houdini v6.5.0
 * A simple collapse-and-expand script., by Chris Ferdinandi.
 * http://github.com/cferdinandi/houdini
 *
 * Free to use under the MIT License.
 * http://gomakethings.com/mit/
 */

(function (root, factory) {
	if ( typeof define === 'function' && define.amd ) {
		define([], factory(root));
	} else if ( typeof exports === 'object' ) {
		module.exports = factory(root);
	} else {
		root.houdini = factory(root);
	}
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {

	'use strict';

	//
	// Variables
	//

	var houdini = {}; // Object for public APIs
	var supports = !!document.querySelector && !!root.addEventListener; // Feature test
	var settings;

	// Default settings
	var defaults = {
		toggleActiveClass: 'active',
		contentActiveClass: 'active',
		initClass: 'js-houdini',
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
	 * Get the closest matching element up the DOM tree
	 * @param {Element} elem Starting element
	 * @param {String} selector Selector to match against (class, ID, or data attribute)
	 * @return {Boolean|Element} Returns false if not match found
	 */
	var getClosest = function (elem, selector) {
		var firstChar = selector.charAt(0);
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
		return false;
	};

	/**
	 * Stop YouTube, Vimeo, and HTML5 videos from playing when leaving the slide
	 * @private
	 * @param  {Element} content The content container the video is in
	 * @param  {String} activeClass The class asigned to expanded content areas
	 */
	var stopVideos = function ( content, activeClass ) {
		if ( !content.classList.contains( activeClass ) ) {
			var iframe = content.querySelector( 'iframe');
			var video = content.querySelector( 'video' );
			if ( iframe ) {
				var iframeSrc = iframe.src;
				iframe.src = iframeSrc;
			}
			if ( video ) {
				video.pause();
			}
		}
	};

	/**
	 * Close all content areas in an expand/collapse group
	 * @private
	 * @param  {Element} toggle The element that toggled the expand or collapse
	 * @param  {Object} settings
	 */
	var closeCollapseGroup = function ( toggle, settings ) {
		if ( !toggle.classList.contains( settings.toggleActiveClass ) && toggle.hasAttribute('data-group') ) {

			// Get all toggles in the group
			var groupName = toggle.getAttribute('data-group');
			var group = document.querySelectorAll('[data-group="' + groupName + '"]');

			// Deactivate each toggle and it's content area
			forEach(group, function (item) {
				var content = document.querySelector( item.getAttribute('data-collapse') );
				item.classList.remove( settings.toggleActiveClass );
				content.classList.remove( settings.contentActiveClass );
			});

		}
	};

	/**
	 * Toggle the collapse/expand widget
	 * @public
	 * @param  {Element} toggle The element that toggled the expand or collapse
	 * @param  {String} contentID The ID of the content area to expand or collapse
	 * @param  {Object} options
	 * @param  {Event} event
	 */
	houdini.toggleContent = function (toggle, contentID, options) {

		var settings = extend( settings || defaults, options || {} );  // Merge user options with defaults
		var content = document.querySelector(contentID); // Get content area

		settings.callbackBefore( toggle, contentID ); // Run callbacks before toggling content

		// Toggle collapse element
		closeCollapseGroup(toggle, settings); // Close collapse group items
		toggle.classList.toggle( settings.toggleActiveClass );// Change text on collapse toggle
		content.classList.toggle( settings.contentActiveClass ); // Collapse or expand content area
		stopVideos( content, settings.contentActiveClass ); // If content area is closed, stop playing any videos

		settings.callbackAfter( toggle, contentID ); // Run callbacks after toggling content

	};

	/**
	 * Handle toggle click events
	 * @private
	 */
	var eventHandler = function (event) {
		var toggle = getClosest(event.target, '[data-collapse]');
		if ( toggle ) {
			if ( toggle.tagName.toLowerCase() === 'a' || toggle.tagName.toLowerCase() === 'button' ) {
				event.preventDefault();
			}
			var contentID = toggle.hasAttribute('data-collapse') ? toggle.getAttribute('data-collapse') : toggle.parentNode.getAttribute('data-collapse');
			houdini.toggleContent( toggle, contentID, settings );
		}
	};

	/**
	 * Destroy the current initialization.
	 * @public
	 */
	houdini.destroy = function () {
		if ( !settings ) return;
		document.documentElement.classList.remove( settings.initClass );
		document.removeEventListener('click', eventHandler, false);
		settings = null;
	};

	/**
	 * Initialize Houdini
	 * @public
	 * @param {Object} options User settings
	 */
	houdini.init = function ( options ) {

		// feature test
		if ( !supports ) return;

		// Destroy any existing initializations
		houdini.destroy();

		// Merge user options with defaults
		settings = extend( defaults, options || {} );

		// Add class to HTML element to activate conditional CSS
		document.documentElement.classList.add( settings.initClass );

		// Listen for all click events
		document.addEventListener('click', eventHandler, false);

	};


	//
	// Public APIs
	//

	return houdini;

});

houdini.init();
