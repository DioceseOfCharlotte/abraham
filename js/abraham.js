'use strict';

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
	var container, button, menu, links, subMenus, i, len;

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
	subMenus = menu.getElementsByTagName('ul');

	// Set menu items with submenus to aria-haspopup="true".
	for (i = 0, len = subMenus.length; i < len; i++) {
		subMenus[i].parentNode.setAttribute('aria-haspopup', 'true');
	}

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

    this.body = document.body;
    this.showButtonEl = document.querySelector('.js-menu-show');
    this.hideButtonEl = document.querySelector('.js-menu-hide');
    this.sideNavEl = document.querySelector('.js-off-canvas');
    this.sideNavContainerEl = document.querySelector('.js-off-canvas-container');

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
      if (!this.sideNavEl.classList.contains('off-canvas--visible')) return;

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
      var translateX = Math.min(0, this.currentX - this.startX);

      if (translateX < -100) {
        evt.preventDefault();
      }
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
      this.sideNavEl.classList.remove('off-canvas--animatable');
      this.sideNavEl.removeEventListener('transitionend', this.onTransitionEnd);
    }
  }, {
    key: 'showSideNav',
    value: function showSideNav() {
      this.sideNavEl.classList.add('off-canvas--animatable');
      this.sideNavEl.classList.add('off-canvas--visible');
      this.body.classList.add('u-overflow-hidden');
      this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
    }
  }, {
    key: 'hideSideNav',
    value: function hideSideNav() {
      this.sideNavEl.classList.add('off-canvas--animatable');
      this.sideNavEl.classList.remove('off-canvas--visible');
      this.body.classList.remove('u-overflow-hidden');
      this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
    }
  }]);

  return SideNav;
}();

new SideNav();
'use strict';

function supportsFlexBox() {
    var test = document.createElement('test');

    test.style.display = 'flex';

    return test.style.display === 'flex';
}

if (supportsFlexBox()) {
    // Modern Flexbox is supported
} else {
    flexibility(document.documentElement);
}