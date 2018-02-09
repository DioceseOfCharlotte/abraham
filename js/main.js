'use strict';

(function (ElementProto) {
	if (typeof ElementProto.matches !== 'function') {
		ElementProto.matches = ElementProto.msMatchesSelector || ElementProto.mozMatchesSelector || ElementProto.webkitMatchesSelector || function matches(selector) {
			var element = this;
			var elements = (element.document || element.ownerDocument).querySelectorAll(selector);
			var index = 0;

			while (elements[index] && elements[index] !== element) {
				++index;
			}

			return Boolean(elements[index]);
		};
	}

	if (typeof ElementProto.closest !== 'function') {
		ElementProto.closest = function closest(selector) {
			var element = this;

			while (element && element.nodeType === 1) {
				if (element.matches(selector)) {
					return element;
				}

				element = element.parentNode;
			}

			return null;
		};
	}
})(window.Element.prototype);
"use strict";

var jsFocusRing = function (scope) {
	scope = scope || window;

	var inputTypesWhitelist = {
		text: 1,
		search: 1,
		url: 1,
		tel: 1,
		email: 1,
		password: 1,
		number: 1,
		date: 1,
		month: 1,
		week: 1,
		time: 1,
		datetime: 1,
		"datetime-local": 1
	};

	var keyboardThrottleTimeoutID = void 0;

	scope.addEventListener("blur", function (event) {
		if (event.target instanceof Element) {
			event.target.removeAttribute("js-focus");
			event.target.removeAttribute("js-focus-ring");
		}
	}, true);

	scope.addEventListener("focus", function (event) {
		var activeElement = document.activeElement;

		if (activeElement instanceof Element && "BODY" !== activeElement.tagName) {
			activeElement.setAttribute("js-focus", "");

			if (keyboardThrottleTimeoutID || scope === event.target || "INPUT" === activeElement.tagName && inputTypesWhitelist[activeElement.type] && !activeElement.readonly || "TEXTAREA" === activeElement.tagName && !activeElement.readonly || "true" === activeElement.contentEditable) {
				activeElement.setAttribute("js-focus-ring", "");
			}
		}
	}, true);

	scope.addEventListener("keydown", function () {
		keyboardThrottleTimeoutID = clearTimeout(keyboardThrottleTimeoutID) || setTimeout(function () {
			keyboardThrottleTimeoutID = 0;
		}, 100);
	}, true);
}();
'use strict';

/*! onClickOrTap.js | (c) 2017 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/onClickOrTap */
/**
 * Run a callback after a click or tap, without running duplicate callbacks for the same event
 * @param  {Node}   elem       The element to listen for clicks and taps on
 * @param  {Function} callback The callback function to run on a click or tap
 */
var onClickOrTap = function onClickOrTap(elem, callback) {

    // Make sure a callback is provided
    if (!callback || typeof callback !== 'function') return;

    // Variables
    var isTouch, startX, startY, distX, distY;

    /**
     * touchstart handler
     * @param  {event} event The touchstart event
     */
    var onTouchStartEvent = function onTouchStartEvent(event) {
        // Disable click event
        isTouch = true;

        // Get the starting location and time when finger first touches surface
        startX = event.changedTouches[0].pageX;
        startY = event.changedTouches[0].pageY;
    };

    /**
     * touchend handler
     * @param  {event} event The touchend event
     */
    var onTouchEndEvent = function onTouchEndEvent(event) {

        // Get the distance travelled and how long it took
        distX = event.changedTouches[0].pageX - startX;
        distY = event.changedTouches[0].pageY - startY;

        // If a swipe happened, do nothing
        if (Math.abs(distX) >= 7 || Math.abs(distY) >= 10) return;

        // Run callback
        callback(event);
    };

    /**
     * click handler
     * @param  {event} event The click event
     */
    var onClickEvent = function onClickEvent(event) {
        // If touch is active, reset and bail
        if (isTouch) {
            isTouch = false;
            return;
        }

        // Run our callback
        callback(event);
    };

    // Event listeners
    elem.addEventListener('touchstart', onTouchStartEvent, false);
    elem.addEventListener('touchend', onTouchEndEvent, false);
    elem.addEventListener('click', onClickEvent, false);
};
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 *
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Usage:
 * const detabinator = new Detabinator(element);
 * detabinator.inert = true;  // Sets all focusable children of element to tabindex=-1
 * detabinator.inert = false; // Restores all focusable children of element
 * Limitations: Doesn't support Shadow DOM v0 :P
 */

var Detabinator = function () {
  function Detabinator(element) {
    _classCallCheck(this, Detabinator);

    if (!element) {
      throw new Error('Missing required argument. new Detabinator needs an element reference');
    }
    this._inert = false;
    this._focusableElementsString = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex], [contenteditable]';
    this._focusableElements = Array.from(element.querySelectorAll(this._focusableElementsString));
  }

  _createClass(Detabinator, [{
    key: 'inert',
    get: function get() {
      return this._inert;
    },
    set: function set(isInert) {
      if (this._inert === isInert) {
        return;
      }

      this._inert = isInert;

      this._focusableElements.forEach(function (child) {
        if (isInert) {
          // If the child has an explict tabindex save it
          if (child.hasAttribute('tabindex')) {
            child.__savedTabindex = child.tabIndex;
          }
          // Set ALL focusable children to tabindex -1
          child.setAttribute('tabindex', -1);
        } else {
          // If the child has a saved tabindex, restore it
          // Because the value could be 0, explicitly check that it's not false
          if (child.__savedTabindex === 0 || child.__savedTabindex) {
            return child.setAttribute('tabindex', child.__savedTabindex);
          } else {
            // Remove tabindex from ANY REMAINING children
            child.removeAttribute('tabindex');
          }
        }
      });
    }
  }]);

  return Detabinator;
}();
'use strict';

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
	var container, button, menu, links, i, len;

	container = document.getElementById('menu-primary');
	if (!container) {
		return;
	}

	button = container.getElementsByTagName('button')[0];
	if ('undefined' === typeof button) {
		return;
	}

	menu = container.getElementsByTagName('ul')[0];

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute('aria-expanded', 'false');
	if (-1 === menu.className.indexOf('nav-menu')) {
		menu.className += ' nav-menu';
	}

	button.onclick = function () {
		if (-1 !== container.className.indexOf('toggled')) {
			container.className = container.className.replace(' toggled', '');
			button.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-expanded', 'false');
		} else {
			container.className += ' toggled';
			button.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-expanded', 'true');
		}
	};

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName('a');

	// Each time a menu link is focused or blurred, toggle focus.
	for (i = 0, len = links.length; i < len; i++) {
		links[i].addEventListener('focus', toggleFocus, true);
		links[i].addEventListener('blur', toggleFocus, true);
	}

	/**
  * Sets or removes .focus class on an element.
  */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while (-1 === self.className.indexOf('nav-menu')) {

			// On li elements toggle the class .focus.
			if ('li' === self.tagName.toLowerCase()) {
				if (-1 !== self.className.indexOf('focus')) {
					self.className = self.className.replace(' focus', '');
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
  * Toggles `focus` class to allow submenu access on tablets.
  */
	(function (container) {
		var touchStartFn,
		    i,
		    parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

		if ('ontouchstart' in window) {
			touchStartFn = function touchStartFn(e) {
				var menuItem = this.parentNode,
				    i;

				if (!menuItem.classList.contains('focus')) {
					e.preventDefault();
					for (i = 0; i < menuItem.parentNode.children.length; ++i) {
						if (menuItem === menuItem.parentNode.children[i]) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove('focus');
					}
					menuItem.classList.add('focus');
				} else {
					menuItem.classList.remove('focus');
				}
			};

			for (i = 0; i < parentLink.length; ++i) {
				parentLink[i].addEventListener('touchstart', touchStartFn, false);
			}
		}
	})(container);
})();
/**
 *
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SideNav = function () {
	function SideNav() {
		_classCallCheck(this, SideNav);

		// Prevent scrolling body when open
		this.body = document.body;
		this.showButtonEl = document.querySelector('.js-menu-show');
		this.hideButtonEl = document.querySelector('.js-menu-hide');
		this.sideNavEl = document.querySelector('.js-side-nav');
		this.sideNavContainerEl = document.querySelector('.js-side-nav-container');
		// Control whether the container's children can be focused
		// Set initial state to inert since the drawer is offscreen
		this.detabinator = new Detabinator(this.sideNavContainerEl);
		this.detabinator.inert = true;

		this.showSideNav = this.showSideNav.bind(this);
		this.hideSideNav = this.hideSideNav.bind(this);
		this.blockClicks = this.blockClicks.bind(this);
		this.onTouchStart = this.onTouchStart.bind(this);
		this.onTouchMove = this.onTouchMove.bind(this);
		this.onTouchEnd = this.onTouchEnd.bind(this);
		this.onTransitionEnd = this.onTransitionEnd.bind(this);
		this.update = this.update.bind(this);

		this.startX = 0;
		this.currentX = 0;
		this.touchingSideNav = false;

		this.supportsPassive = undefined;
		this.addEventListeners();
	}

	// apply passive event listening if it's supported


	_createClass(SideNav, [{
		key: 'applyPassive',
		value: function applyPassive() {
			if (this.supportsPassive !== undefined) {
				return this.supportsPassive ? { passive: true } : false;
			}
			// feature detect
			var isSupported = false;
			try {
				document.addEventListener('test', null, { get passive() {
						isSupported = true;
					} });
			} catch (e) {}
			this.supportsPassive = isSupported;
			return this.applyPassive();
		}
	}, {
		key: 'addEventListeners',
		value: function addEventListeners() {
			this.showButtonEl.addEventListener('click', this.showSideNav);
			this.hideButtonEl.addEventListener('click', this.hideSideNav);
			this.sideNavEl.addEventListener('click', this.hideSideNav);
			this.sideNavContainerEl.addEventListener('click', this.blockClicks);

			this.sideNavEl.addEventListener('touchstart', this.onTouchStart, this.applyPassive());
			this.sideNavEl.addEventListener('touchmove', this.onTouchMove, this.applyPassive());
			this.sideNavEl.addEventListener('touchend', this.onTouchEnd);
		}
	}, {
		key: 'onTouchStart',
		value: function onTouchStart(evt) {
			if (!this.sideNavEl.classList.contains('side-nav--visible')) return;

			this.startX = evt.touches[0].pageX;
			this.currentX = this.startX;

			this.touchingSideNav = true;
			requestAnimationFrame(this.update);
		}
	}, {
		key: 'onTouchMove',
		value: function onTouchMove(evt) {
			if (!this.touchingSideNav) return;

			this.currentX = evt.touches[0].pageX;
		}
	}, {
		key: 'onTouchEnd',
		value: function onTouchEnd(evt) {
			if (!this.touchingSideNav) return;

			this.touchingSideNav = false;

			var translateX = Math.min(0, this.currentX - this.startX);
			this.sideNavContainerEl.style.transform = '';

			if (translateX < -100) {
				this.hideSideNav();
			}
		}
	}, {
		key: 'update',
		value: function update() {
			if (!this.touchingSideNav) return;

			requestAnimationFrame(this.update);

			var translateX = Math.min(0, this.currentX - this.startX);
			this.sideNavContainerEl.style.transform = 'translateX(' + translateX + 'px)';
		}
	}, {
		key: 'blockClicks',
		value: function blockClicks(evt) {
			evt.stopPropagation();
		}
	}, {
		key: 'onTransitionEnd',
		value: function onTransitionEnd(evt) {
			this.sideNavEl.classList.remove('side-nav--animatable');
			this.sideNavEl.removeEventListener('transitionend', this.onTransitionEnd);
		}
	}, {
		key: 'showSideNav',
		value: function showSideNav() {
			this.body.classList.add('u-overflow-hidden');
			this.sideNavEl.classList.add('side-nav--animatable');
			this.sideNavEl.classList.add('side-nav--visible');
			this.detabinator.inert = false;
			this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
		}
	}, {
		key: 'hideSideNav',
		value: function hideSideNav() {
			this.body.classList.remove('u-overflow-hidden');
			this.sideNavEl.classList.add('side-nav--animatable');
			this.sideNavEl.classList.remove('side-nav--visible');
			this.detabinator.inert = true;
			this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
		}
	}]);

	return SideNav;
}();

if (document.body.classList.contains('has-oc-sidebar')) {
	new SideNav();
}
/**
 * eventually
 */
"use strict";
//# sourceMappingURL=main.js.map
