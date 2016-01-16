/**
 * @license
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * A component handler interface using the revealing module design pattern.
 * More details on this design pattern here:
 * https://github.com/jasonmayes/mdl-component-design-pattern
 *
 * @author Jason Mayes.
 */
/* exported componentHandler */

// Pre-defining the componentHandler interface, for closure documentation and
// static verification.
var componentHandler = {
	/**
	 * Searches existing DOM for elements of our component type and upgrades them
	 * if they have not already been upgraded.
	 *
	 * @param {string=} optJsClass the programatic name of the element class we
	 * need to create a new instance of.
	 * @param {string=} optCssClass the name of the CSS class elements of this
	 * type will have.
	 */
	upgradeDom: function (optJsClass, optCssClass) {},
	/**
	 * Upgrades a specific element rather than all in the DOM.
	 *
	 * @param {!Element} element The element we wish to upgrade.
	 * @param {string=} optJsClass Optional name of the class we want to upgrade
	 * the element to.
	 */
	upgradeElement: function (element, optJsClass) {},
	/**
	 * Upgrades a specific list of elements rather than all in the DOM.
	 *
	 * @param {!Element|!Array<!Element>|!NodeList|!HTMLCollection} elements
	 * The elements we wish to upgrade.
	 */
	upgradeElements: function (elements) {},
	/**
	 * Upgrades all registered components found in the current DOM. This is
	 * automatically called on window load.
	 */
	upgradeAllRegistered: function () {},
	/**
	 * Allows user to be alerted to any upgrades that are performed for a given
	 * component type
	 *
	 * @param {string} jsClass The class name of the MDL component we wish
	 * to hook into for any upgrades performed.
	 * @param {function(!HTMLElement)} callback The function to call upon an
	 * upgrade. This function should expect 1 parameter - the HTMLElement which
	 * got upgraded.
	 */
	registerUpgradedCallback: function (jsClass, callback) {},
	/**
	 * Registers a class for future use and attempts to upgrade existing DOM.
	 *
	 * @param {componentHandler.ComponentConfigPublic} config the registration configuration
	 */
	register: function (config) {},
	/**
	 * Downgrade either a given node, an array of nodes, or a NodeList.
	 *
	 * @param {!Node|!Array<!Node>|!NodeList} nodes
	 */
	downgradeElements: function (nodes) {}
};

componentHandler = (function () {
	'use strict';

	/** @type {!Array<componentHandler.ComponentConfig>} */
	var registeredComponents_ = [];

	/** @type {!Array<componentHandler.Component>} */
	var createdComponents_ = [];

	var downgradeMethod_ = 'mdlDowngrade';
	var componentConfigProperty_ = 'mdlComponentConfigInternal_';

	/**
	 * Searches registered components for a class we are interested in using.
	 * Optionally replaces a match with passed object if specified.
	 *
	 * @param {string} name The name of a class we want to use.
	 * @param {componentHandler.ComponentConfig=} optReplace Optional object to replace match with.
	 * @return {!Object|boolean}
	 * @private
	 */
	function findRegisteredClass_(name, optReplace) {
		for (var i = 0; i < registeredComponents_.length; i++) {
			if (registeredComponents_[i].className === name) {
				if (typeof optReplace !== 'undefined') {
					registeredComponents_[i] = optReplace;
				}
				return registeredComponents_[i];
			}
		}
		return false;
	}

	/**
	 * Returns an array of the classNames of the upgraded classes on the element.
	 *
	 * @param {!Element} element The element to fetch data from.
	 * @return {!Array<string>}
	 * @private
	 */
	function getUpgradedListOfElement_(element) {
		var dataUpgraded = element.getAttribute('data-upgraded');
		// Use `['']` as default value to conform the `,name,name...` style.
		return dataUpgraded === null ? [''] : dataUpgraded.split(',');
	}

	/**
	 * Returns true if the given element has already been upgraded for the given
	 * class.
	 *
	 * @param {!Element} element The element we want to check.
	 * @param {string} jsClass The class to check for.
	 * @returns {boolean}
	 * @private
	 */
	function isElementUpgraded_(element, jsClass) {
		var upgradedList = getUpgradedListOfElement_(element);
		return upgradedList.indexOf(jsClass) !== -1;
	}

	/**
	 * Searches existing DOM for elements of our component type and upgrades them
	 * if they have not already been upgraded.
	 *
	 * @param {string=} optJsClass the programatic name of the element class we
	 * need to create a new instance of.
	 * @param {string=} optCssClass the name of the CSS class elements of this
	 * type will have.
	 */
	function upgradeDomInternal(optJsClass, optCssClass) {
		if (typeof optJsClass === 'undefined' &&
			typeof optCssClass === 'undefined') {
			for (var i = 0; i < registeredComponents_.length; i++) {
				upgradeDomInternal(registeredComponents_[i].className,
					registeredComponents_[i].cssClass);
			}
		} else {
			var jsClass = (optJsClass);
			if (typeof optCssClass === 'undefined') {
				var registeredClass = findRegisteredClass_(jsClass);
				if (registeredClass) {
					optCssClass = registeredClass.cssClass;
				}
			}

			var elements = document.querySelectorAll('.' + optCssClass);
			for (var n = 0; n < elements.length; n++) {
				upgradeElementInternal(elements[n], jsClass);
			}
		}
	}

	/**
	 * Upgrades a specific element rather than all in the DOM.
	 *
	 * @param {!Element} element The element we wish to upgrade.
	 * @param {string=} optJsClass Optional name of the class we want to upgrade
	 * the element to.
	 */
	function upgradeElementInternal(element, optJsClass) {
		// Verify argument type.
		if (!(typeof element === 'object' && element instanceof Element)) {
			throw new Error('Invalid argument provided to upgrade MDL element.');
		}
		var upgradedList = getUpgradedListOfElement_(element);
		var classesToUpgrade = [];
		// If jsClass is not provided scan the registered components to find the
		// ones matching the element's CSS classList.
		if (!optJsClass) {
			var classList = element.classList;
			registeredComponents_.forEach(function (component) {
				// Match CSS & Not to be upgraded & Not upgraded.
				if (classList.contains(component.cssClass) &&
					classesToUpgrade.indexOf(component) === -1 &&
					!isElementUpgraded_(element, component.className)) {
					classesToUpgrade.push(component);
				}
			});
		} else if (!isElementUpgraded_(element, optJsClass)) {
			classesToUpgrade.push(findRegisteredClass_(optJsClass));
		}

		// Upgrade the element for each classes.
		for (var i = 0, n = classesToUpgrade.length, registeredClass; i < n; i++) {
			registeredClass = classesToUpgrade[i];
			if (registeredClass) {
				// Mark element as upgraded.
				upgradedList.push(registeredClass.className);
				element.setAttribute('data-upgraded', upgradedList.join(','));
				var instance = new registeredClass.classConstructor(element);
				instance[componentConfigProperty_] = registeredClass;
				createdComponents_.push(instance);
				// Call any callbacks the user has registered with this component type.
				for (var j = 0, m = registeredClass.callbacks.length; j < m; j++) {
					registeredClass.callbacks[j](element);
				}

				if (registeredClass.widget) {
					// Assign per element instance for control over API
					element[registeredClass.className] = instance;
				}
			} else {
				throw new Error(
					'Unable to find a registered component for the given class.');
			}

			var ev = document.createEvent('Events');
			ev.initEvent('mdl-componentupgraded', true, true);
			element.dispatchEvent(ev);
		}
	}

	/**
	 * Upgrades a specific list of elements rather than all in the DOM.
	 *
	 * @param {!Element|!Array<!Element>|!NodeList|!HTMLCollection} elements
	 * The elements we wish to upgrade.
	 */
	function upgradeElementsInternal(elements) {
		if (!Array.isArray(elements)) {
			if (typeof elements.item === 'function') {
				elements = Array.prototype.slice.call((elements));
			} else {
				elements = [elements];
			}
		}
		for (var i = 0, n = elements.length, element; i < n; i++) {
			element = elements[i];
			if (element instanceof HTMLElement) {
				upgradeElementInternal(element);
				if (element.children.length > 0) {
					upgradeElementsInternal(element.children);
				}
			}
		}
	}

	/**
	 * Registers a class for future use and attempts to upgrade existing DOM.
	 *
	 * @param {componentHandler.ComponentConfigPublic} config
	 */
	function registerInternal(config) {
		// In order to support both Closure-compiled and uncompiled code accessing
		// this method, we need to allow for both the dot and array syntax for
		// property access. You'll therefore see the `foo.bar || foo['bar']`
		// pattern repeated across this method.
		var widgetMissing = (typeof config.widget === 'undefined' &&
			typeof config['widget'] === 'undefined');
		var widget = true;

		if (!widgetMissing) {
			widget = config.widget || config['widget'];
		}

		var newConfig = ({
			classConstructor: config.constructor || config['constructor'],
			className: config.classAsString || config['classAsString'],
			cssClass: config.cssClass || config['cssClass'],
			widget: widget,
			callbacks: []
		});

		registeredComponents_.forEach(function (item) {
			if (item.cssClass === newConfig.cssClass) {
				throw new Error('The provided cssClass has already been registered: ' + item.cssClass);
			}
			if (item.className === newConfig.className) {
				throw new Error('The provided className has already been registered');
			}
		});

		if (config.constructor.prototype
			.hasOwnProperty(componentConfigProperty_)) {
			throw new Error(
				'MDL component classes must not have ' + componentConfigProperty_ +
				' defined as a property.');
		}

		var found = findRegisteredClass_(config.classAsString, newConfig);

		if (!found) {
			registeredComponents_.push(newConfig);
		}
	}

	/**
	 * Allows user to be alerted to any upgrades that are performed for a given
	 * component type
	 *
	 * @param {string} jsClass The class name of the MDL component we wish
	 * to hook into for any upgrades performed.
	 * @param {function(!HTMLElement)} callback The function to call upon an
	 * upgrade. This function should expect 1 parameter - the HTMLElement which
	 * got upgraded.
	 */
	function registerUpgradedCallbackInternal(jsClass, callback) {
		var regClass = findRegisteredClass_(jsClass);
		if (regClass) {
			regClass.callbacks.push(callback);
		}
	}

	/**
	 * Upgrades all registered components found in the current DOM. This is
	 * automatically called on window load.
	 */
	function upgradeAllRegisteredInternal() {
		for (var n = 0; n < registeredComponents_.length; n++) {
			upgradeDomInternal(registeredComponents_[n].className);
		}
	}

	/**
	 * Finds a created component by a given DOM node.
	 *
	 * @param {!Node} node
	 * @return {?componentHandler.Component}
	 */
	function findCreatedComponentByNodeInternal(node) {
		for (var n = 0; n < createdComponents_.length; n++) {
			var component = createdComponents_[n];
			if (component.element_ === node) {
				return component;
			}
		}
		return null;
	}

	/**
	 * Check the component for the downgrade method.
	 * Execute if found.
	 * Remove component from createdComponents list.
	 *
	 * @param {?componentHandler.Component} component
	 */
	function deconstructComponentInternal(component) {
		if (component &&
			component[componentConfigProperty_]
			.classConstructor.prototype
			.hasOwnProperty(downgradeMethod_)) {
			component[downgradeMethod_]();
			var componentIndex = createdComponents_.indexOf(component);
			createdComponents_.splice(componentIndex, 1);

			var upgrades = component.element_.getAttribute('data-upgraded').split(',');
			var componentPlace = upgrades.indexOf(
				component[componentConfigProperty_].classAsString);
			upgrades.splice(componentPlace, 1);
			component.element_.setAttribute('data-upgraded', upgrades.join(','));

			var ev = document.createEvent('Events');
			ev.initEvent('mdl-componentdowngraded', true, true);
			component.element_.dispatchEvent(ev);
		}
	}

	/**
	 * Downgrade either a given node, an array of nodes, or a NodeList.
	 *
	 * @param {!Node|!Array<!Node>|!NodeList} nodes
	 */
	function downgradeNodesInternal(nodes) {
		/**
		 * Auxiliary function to downgrade a single node.
		 * @param  {!Node} node the node to be downgraded
		 */
		var downgradeNode = function (node) {
			deconstructComponentInternal(findCreatedComponentByNodeInternal(node));
		};
		if (nodes instanceof Array || nodes instanceof NodeList) {
			for (var n = 0; n < nodes.length; n++) {
				downgradeNode(nodes[n]);
			}
		} else if (nodes instanceof Node) {
			downgradeNode(nodes);
		} else {
			throw new Error('Invalid argument provided to downgrade MDL nodes.');
		}
	}

	// Now return the functions that should be made public with their publicly
	// facing names...
	return {
		upgradeDom: upgradeDomInternal,
		upgradeElement: upgradeElementInternal,
		upgradeElements: upgradeElementsInternal,
		upgradeAllRegistered: upgradeAllRegisteredInternal,
		registerUpgradedCallback: registerUpgradedCallbackInternal,
		register: registerInternal,
		downgradeElements: downgradeNodesInternal
	};
})();

/**
 * Describes the type of a registered component type managed by
 * componentHandler. Provided for benefit of the Closure compiler.
 *
 * @typedef {{
 *   constructor: Function,
 *   classAsString: string,
 *   cssClass: string,
 *   widget: (string|boolean|undefined)
 * }}
 */
componentHandler.ComponentConfigPublic; // jshint ignore:line

/**
 * Describes the type of a registered component type managed by
 * componentHandler. Provided for benefit of the Closure compiler.
 *
 * @typedef {{
 *   constructor: !Function,
 *   className: string,
 *   cssClass: string,
 *   widget: (string|boolean),
 *   callbacks: !Array<function(!HTMLElement)>
 * }}
 */
componentHandler.ComponentConfig; // jshint ignore:line

/**
 * Created component (i.e., upgraded element) type as managed by
 * componentHandler. Provided for benefit of the Closure compiler.
 *
 * @typedef {{
 *   element_: !HTMLElement,
 *   className: string,
 *   classAsString: string,
 *   cssClass: string,
 *   widget: string
 * }}
 */
componentHandler.Component; // jshint ignore:line

// Export all symbols, for the benefit of Closure compiler.
// No effect on uncompiled code.
componentHandler['upgradeDom'] = componentHandler.upgradeDom;
componentHandler['upgradeElement'] = componentHandler.upgradeElement;
componentHandler['upgradeElements'] = componentHandler.upgradeElements;
componentHandler['upgradeAllRegistered'] =
	componentHandler.upgradeAllRegistered;
componentHandler['registerUpgradedCallback'] =
	componentHandler.registerUpgradedCallback;
componentHandler['register'] = componentHandler.register;
componentHandler['downgradeElements'] = componentHandler.downgradeElements;
window.componentHandler = componentHandler;
window['componentHandler'] = componentHandler;

window.addEventListener('load', function () {
	'use strict';

	/**
	 * Performs a "Cutting the mustard" test. If the browser supports the features
	 * tested, adds a mdl-js class to the <html> element. It then upgrades all MDL
	 * components requiring JavaScript.
	 */
	if ('classList' in document.createElement('div') &&
		'querySelector' in document &&
		'addEventListener' in window && Array.prototype.forEach) {
		document.documentElement.classList.add('mdl-js');
		componentHandler.upgradeAllRegistered();
	} else {
		/**
		 * Dummy function to avoid JS errors.
		 */
		componentHandler.upgradeElement = function () {};
		/**
		 * Dummy function to avoid JS errors.
		 */
		componentHandler.register = function () {};
	}
});

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtZGxDb21wb25lbnRIYW5kbGVyLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQGxpY2Vuc2VcbiAqIENvcHlyaWdodCAyMDE1IEdvb2dsZSBJbmMuIEFsbCBSaWdodHMgUmVzZXJ2ZWQuXG4gKlxuICogTGljZW5zZWQgdW5kZXIgdGhlIEFwYWNoZSBMaWNlbnNlLCBWZXJzaW9uIDIuMCAodGhlIFwiTGljZW5zZVwiKTtcbiAqIHlvdSBtYXkgbm90IHVzZSB0aGlzIGZpbGUgZXhjZXB0IGluIGNvbXBsaWFuY2Ugd2l0aCB0aGUgTGljZW5zZS5cbiAqIFlvdSBtYXkgb2J0YWluIGEgY29weSBvZiB0aGUgTGljZW5zZSBhdFxuICpcbiAqICAgICAgaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wXG4gKlxuICogVW5sZXNzIHJlcXVpcmVkIGJ5IGFwcGxpY2FibGUgbGF3IG9yIGFncmVlZCB0byBpbiB3cml0aW5nLCBzb2Z0d2FyZVxuICogZGlzdHJpYnV0ZWQgdW5kZXIgdGhlIExpY2Vuc2UgaXMgZGlzdHJpYnV0ZWQgb24gYW4gXCJBUyBJU1wiIEJBU0lTLFxuICogV0lUSE9VVCBXQVJSQU5USUVTIE9SIENPTkRJVElPTlMgT0YgQU5ZIEtJTkQsIGVpdGhlciBleHByZXNzIG9yIGltcGxpZWQuXG4gKiBTZWUgdGhlIExpY2Vuc2UgZm9yIHRoZSBzcGVjaWZpYyBsYW5ndWFnZSBnb3Zlcm5pbmcgcGVybWlzc2lvbnMgYW5kXG4gKiBsaW1pdGF0aW9ucyB1bmRlciB0aGUgTGljZW5zZS5cbiAqL1xuXG4vKipcbiAqIEEgY29tcG9uZW50IGhhbmRsZXIgaW50ZXJmYWNlIHVzaW5nIHRoZSByZXZlYWxpbmcgbW9kdWxlIGRlc2lnbiBwYXR0ZXJuLlxuICogTW9yZSBkZXRhaWxzIG9uIHRoaXMgZGVzaWduIHBhdHRlcm4gaGVyZTpcbiAqIGh0dHBzOi8vZ2l0aHViLmNvbS9qYXNvbm1heWVzL21kbC1jb21wb25lbnQtZGVzaWduLXBhdHRlcm5cbiAqXG4gKiBAYXV0aG9yIEphc29uIE1heWVzLlxuICovXG4vKiBleHBvcnRlZCBjb21wb25lbnRIYW5kbGVyICovXG5cbi8vIFByZS1kZWZpbmluZyB0aGUgY29tcG9uZW50SGFuZGxlciBpbnRlcmZhY2UsIGZvciBjbG9zdXJlIGRvY3VtZW50YXRpb24gYW5kXG4vLyBzdGF0aWMgdmVyaWZpY2F0aW9uLlxudmFyIGNvbXBvbmVudEhhbmRsZXIgPSB7XG5cdC8qKlxuXHQgKiBTZWFyY2hlcyBleGlzdGluZyBET00gZm9yIGVsZW1lbnRzIG9mIG91ciBjb21wb25lbnQgdHlwZSBhbmQgdXBncmFkZXMgdGhlbVxuXHQgKiBpZiB0aGV5IGhhdmUgbm90IGFscmVhZHkgYmVlbiB1cGdyYWRlZC5cblx0ICpcblx0ICogQHBhcmFtIHtzdHJpbmc9fSBvcHRKc0NsYXNzIHRoZSBwcm9ncmFtYXRpYyBuYW1lIG9mIHRoZSBlbGVtZW50IGNsYXNzIHdlXG5cdCAqIG5lZWQgdG8gY3JlYXRlIGEgbmV3IGluc3RhbmNlIG9mLlxuXHQgKiBAcGFyYW0ge3N0cmluZz19IG9wdENzc0NsYXNzIHRoZSBuYW1lIG9mIHRoZSBDU1MgY2xhc3MgZWxlbWVudHMgb2YgdGhpc1xuXHQgKiB0eXBlIHdpbGwgaGF2ZS5cblx0ICovXG5cdHVwZ3JhZGVEb206IGZ1bmN0aW9uIChvcHRKc0NsYXNzLCBvcHRDc3NDbGFzcykge30sXG5cdC8qKlxuXHQgKiBVcGdyYWRlcyBhIHNwZWNpZmljIGVsZW1lbnQgcmF0aGVyIHRoYW4gYWxsIGluIHRoZSBET00uXG5cdCAqXG5cdCAqIEBwYXJhbSB7IUVsZW1lbnR9IGVsZW1lbnQgVGhlIGVsZW1lbnQgd2Ugd2lzaCB0byB1cGdyYWRlLlxuXHQgKiBAcGFyYW0ge3N0cmluZz19IG9wdEpzQ2xhc3MgT3B0aW9uYWwgbmFtZSBvZiB0aGUgY2xhc3Mgd2Ugd2FudCB0byB1cGdyYWRlXG5cdCAqIHRoZSBlbGVtZW50IHRvLlxuXHQgKi9cblx0dXBncmFkZUVsZW1lbnQ6IGZ1bmN0aW9uIChlbGVtZW50LCBvcHRKc0NsYXNzKSB7fSxcblx0LyoqXG5cdCAqIFVwZ3JhZGVzIGEgc3BlY2lmaWMgbGlzdCBvZiBlbGVtZW50cyByYXRoZXIgdGhhbiBhbGwgaW4gdGhlIERPTS5cblx0ICpcblx0ICogQHBhcmFtIHshRWxlbWVudHwhQXJyYXk8IUVsZW1lbnQ+fCFOb2RlTGlzdHwhSFRNTENvbGxlY3Rpb259IGVsZW1lbnRzXG5cdCAqIFRoZSBlbGVtZW50cyB3ZSB3aXNoIHRvIHVwZ3JhZGUuXG5cdCAqL1xuXHR1cGdyYWRlRWxlbWVudHM6IGZ1bmN0aW9uIChlbGVtZW50cykge30sXG5cdC8qKlxuXHQgKiBVcGdyYWRlcyBhbGwgcmVnaXN0ZXJlZCBjb21wb25lbnRzIGZvdW5kIGluIHRoZSBjdXJyZW50IERPTS4gVGhpcyBpc1xuXHQgKiBhdXRvbWF0aWNhbGx5IGNhbGxlZCBvbiB3aW5kb3cgbG9hZC5cblx0ICovXG5cdHVwZ3JhZGVBbGxSZWdpc3RlcmVkOiBmdW5jdGlvbiAoKSB7fSxcblx0LyoqXG5cdCAqIEFsbG93cyB1c2VyIHRvIGJlIGFsZXJ0ZWQgdG8gYW55IHVwZ3JhZGVzIHRoYXQgYXJlIHBlcmZvcm1lZCBmb3IgYSBnaXZlblxuXHQgKiBjb21wb25lbnQgdHlwZVxuXHQgKlxuXHQgKiBAcGFyYW0ge3N0cmluZ30ganNDbGFzcyBUaGUgY2xhc3MgbmFtZSBvZiB0aGUgTURMIGNvbXBvbmVudCB3ZSB3aXNoXG5cdCAqIHRvIGhvb2sgaW50byBmb3IgYW55IHVwZ3JhZGVzIHBlcmZvcm1lZC5cblx0ICogQHBhcmFtIHtmdW5jdGlvbighSFRNTEVsZW1lbnQpfSBjYWxsYmFjayBUaGUgZnVuY3Rpb24gdG8gY2FsbCB1cG9uIGFuXG5cdCAqIHVwZ3JhZGUuIFRoaXMgZnVuY3Rpb24gc2hvdWxkIGV4cGVjdCAxIHBhcmFtZXRlciAtIHRoZSBIVE1MRWxlbWVudCB3aGljaFxuXHQgKiBnb3QgdXBncmFkZWQuXG5cdCAqL1xuXHRyZWdpc3RlclVwZ3JhZGVkQ2FsbGJhY2s6IGZ1bmN0aW9uIChqc0NsYXNzLCBjYWxsYmFjaykge30sXG5cdC8qKlxuXHQgKiBSZWdpc3RlcnMgYSBjbGFzcyBmb3IgZnV0dXJlIHVzZSBhbmQgYXR0ZW1wdHMgdG8gdXBncmFkZSBleGlzdGluZyBET00uXG5cdCAqXG5cdCAqIEBwYXJhbSB7Y29tcG9uZW50SGFuZGxlci5Db21wb25lbnRDb25maWdQdWJsaWN9IGNvbmZpZyB0aGUgcmVnaXN0cmF0aW9uIGNvbmZpZ3VyYXRpb25cblx0ICovXG5cdHJlZ2lzdGVyOiBmdW5jdGlvbiAoY29uZmlnKSB7fSxcblx0LyoqXG5cdCAqIERvd25ncmFkZSBlaXRoZXIgYSBnaXZlbiBub2RlLCBhbiBhcnJheSBvZiBub2Rlcywgb3IgYSBOb2RlTGlzdC5cblx0ICpcblx0ICogQHBhcmFtIHshTm9kZXwhQXJyYXk8IU5vZGU+fCFOb2RlTGlzdH0gbm9kZXNcblx0ICovXG5cdGRvd25ncmFkZUVsZW1lbnRzOiBmdW5jdGlvbiAobm9kZXMpIHt9XG59O1xuXG5jb21wb25lbnRIYW5kbGVyID0gKGZ1bmN0aW9uICgpIHtcblx0J3VzZSBzdHJpY3QnO1xuXG5cdC8qKiBAdHlwZSB7IUFycmF5PGNvbXBvbmVudEhhbmRsZXIuQ29tcG9uZW50Q29uZmlnPn0gKi9cblx0dmFyIHJlZ2lzdGVyZWRDb21wb25lbnRzXyA9IFtdO1xuXG5cdC8qKiBAdHlwZSB7IUFycmF5PGNvbXBvbmVudEhhbmRsZXIuQ29tcG9uZW50Pn0gKi9cblx0dmFyIGNyZWF0ZWRDb21wb25lbnRzXyA9IFtdO1xuXG5cdHZhciBkb3duZ3JhZGVNZXRob2RfID0gJ21kbERvd25ncmFkZSc7XG5cdHZhciBjb21wb25lbnRDb25maWdQcm9wZXJ0eV8gPSAnbWRsQ29tcG9uZW50Q29uZmlnSW50ZXJuYWxfJztcblxuXHQvKipcblx0ICogU2VhcmNoZXMgcmVnaXN0ZXJlZCBjb21wb25lbnRzIGZvciBhIGNsYXNzIHdlIGFyZSBpbnRlcmVzdGVkIGluIHVzaW5nLlxuXHQgKiBPcHRpb25hbGx5IHJlcGxhY2VzIGEgbWF0Y2ggd2l0aCBwYXNzZWQgb2JqZWN0IGlmIHNwZWNpZmllZC5cblx0ICpcblx0ICogQHBhcmFtIHtzdHJpbmd9IG5hbWUgVGhlIG5hbWUgb2YgYSBjbGFzcyB3ZSB3YW50IHRvIHVzZS5cblx0ICogQHBhcmFtIHtjb21wb25lbnRIYW5kbGVyLkNvbXBvbmVudENvbmZpZz19IG9wdFJlcGxhY2UgT3B0aW9uYWwgb2JqZWN0IHRvIHJlcGxhY2UgbWF0Y2ggd2l0aC5cblx0ICogQHJldHVybiB7IU9iamVjdHxib29sZWFufVxuXHQgKiBAcHJpdmF0ZVxuXHQgKi9cblx0ZnVuY3Rpb24gZmluZFJlZ2lzdGVyZWRDbGFzc18obmFtZSwgb3B0UmVwbGFjZSkge1xuXHRcdGZvciAodmFyIGkgPSAwOyBpIDwgcmVnaXN0ZXJlZENvbXBvbmVudHNfLmxlbmd0aDsgaSsrKSB7XG5cdFx0XHRpZiAocmVnaXN0ZXJlZENvbXBvbmVudHNfW2ldLmNsYXNzTmFtZSA9PT0gbmFtZSkge1xuXHRcdFx0XHRpZiAodHlwZW9mIG9wdFJlcGxhY2UgIT09ICd1bmRlZmluZWQnKSB7XG5cdFx0XHRcdFx0cmVnaXN0ZXJlZENvbXBvbmVudHNfW2ldID0gb3B0UmVwbGFjZTtcblx0XHRcdFx0fVxuXHRcdFx0XHRyZXR1cm4gcmVnaXN0ZXJlZENvbXBvbmVudHNfW2ldO1xuXHRcdFx0fVxuXHRcdH1cblx0XHRyZXR1cm4gZmFsc2U7XG5cdH1cblxuXHQvKipcblx0ICogUmV0dXJucyBhbiBhcnJheSBvZiB0aGUgY2xhc3NOYW1lcyBvZiB0aGUgdXBncmFkZWQgY2xhc3NlcyBvbiB0aGUgZWxlbWVudC5cblx0ICpcblx0ICogQHBhcmFtIHshRWxlbWVudH0gZWxlbWVudCBUaGUgZWxlbWVudCB0byBmZXRjaCBkYXRhIGZyb20uXG5cdCAqIEByZXR1cm4geyFBcnJheTxzdHJpbmc+fVxuXHQgKiBAcHJpdmF0ZVxuXHQgKi9cblx0ZnVuY3Rpb24gZ2V0VXBncmFkZWRMaXN0T2ZFbGVtZW50XyhlbGVtZW50KSB7XG5cdFx0dmFyIGRhdGFVcGdyYWRlZCA9IGVsZW1lbnQuZ2V0QXR0cmlidXRlKCdkYXRhLXVwZ3JhZGVkJyk7XG5cdFx0Ly8gVXNlIGBbJyddYCBhcyBkZWZhdWx0IHZhbHVlIHRvIGNvbmZvcm0gdGhlIGAsbmFtZSxuYW1lLi4uYCBzdHlsZS5cblx0XHRyZXR1cm4gZGF0YVVwZ3JhZGVkID09PSBudWxsID8gWycnXSA6IGRhdGFVcGdyYWRlZC5zcGxpdCgnLCcpO1xuXHR9XG5cblx0LyoqXG5cdCAqIFJldHVybnMgdHJ1ZSBpZiB0aGUgZ2l2ZW4gZWxlbWVudCBoYXMgYWxyZWFkeSBiZWVuIHVwZ3JhZGVkIGZvciB0aGUgZ2l2ZW5cblx0ICogY2xhc3MuXG5cdCAqXG5cdCAqIEBwYXJhbSB7IUVsZW1lbnR9IGVsZW1lbnQgVGhlIGVsZW1lbnQgd2Ugd2FudCB0byBjaGVjay5cblx0ICogQHBhcmFtIHtzdHJpbmd9IGpzQ2xhc3MgVGhlIGNsYXNzIHRvIGNoZWNrIGZvci5cblx0ICogQHJldHVybnMge2Jvb2xlYW59XG5cdCAqIEBwcml2YXRlXG5cdCAqL1xuXHRmdW5jdGlvbiBpc0VsZW1lbnRVcGdyYWRlZF8oZWxlbWVudCwganNDbGFzcykge1xuXHRcdHZhciB1cGdyYWRlZExpc3QgPSBnZXRVcGdyYWRlZExpc3RPZkVsZW1lbnRfKGVsZW1lbnQpO1xuXHRcdHJldHVybiB1cGdyYWRlZExpc3QuaW5kZXhPZihqc0NsYXNzKSAhPT0gLTE7XG5cdH1cblxuXHQvKipcblx0ICogU2VhcmNoZXMgZXhpc3RpbmcgRE9NIGZvciBlbGVtZW50cyBvZiBvdXIgY29tcG9uZW50IHR5cGUgYW5kIHVwZ3JhZGVzIHRoZW1cblx0ICogaWYgdGhleSBoYXZlIG5vdCBhbHJlYWR5IGJlZW4gdXBncmFkZWQuXG5cdCAqXG5cdCAqIEBwYXJhbSB7c3RyaW5nPX0gb3B0SnNDbGFzcyB0aGUgcHJvZ3JhbWF0aWMgbmFtZSBvZiB0aGUgZWxlbWVudCBjbGFzcyB3ZVxuXHQgKiBuZWVkIHRvIGNyZWF0ZSBhIG5ldyBpbnN0YW5jZSBvZi5cblx0ICogQHBhcmFtIHtzdHJpbmc9fSBvcHRDc3NDbGFzcyB0aGUgbmFtZSBvZiB0aGUgQ1NTIGNsYXNzIGVsZW1lbnRzIG9mIHRoaXNcblx0ICogdHlwZSB3aWxsIGhhdmUuXG5cdCAqL1xuXHRmdW5jdGlvbiB1cGdyYWRlRG9tSW50ZXJuYWwob3B0SnNDbGFzcywgb3B0Q3NzQ2xhc3MpIHtcblx0XHRpZiAodHlwZW9mIG9wdEpzQ2xhc3MgPT09ICd1bmRlZmluZWQnICYmXG5cdFx0XHR0eXBlb2Ygb3B0Q3NzQ2xhc3MgPT09ICd1bmRlZmluZWQnKSB7XG5cdFx0XHRmb3IgKHZhciBpID0gMDsgaSA8IHJlZ2lzdGVyZWRDb21wb25lbnRzXy5sZW5ndGg7IGkrKykge1xuXHRcdFx0XHR1cGdyYWRlRG9tSW50ZXJuYWwocmVnaXN0ZXJlZENvbXBvbmVudHNfW2ldLmNsYXNzTmFtZSxcblx0XHRcdFx0XHRyZWdpc3RlcmVkQ29tcG9uZW50c19baV0uY3NzQ2xhc3MpO1xuXHRcdFx0fVxuXHRcdH0gZWxzZSB7XG5cdFx0XHR2YXIganNDbGFzcyA9IChvcHRKc0NsYXNzKTtcblx0XHRcdGlmICh0eXBlb2Ygb3B0Q3NzQ2xhc3MgPT09ICd1bmRlZmluZWQnKSB7XG5cdFx0XHRcdHZhciByZWdpc3RlcmVkQ2xhc3MgPSBmaW5kUmVnaXN0ZXJlZENsYXNzXyhqc0NsYXNzKTtcblx0XHRcdFx0aWYgKHJlZ2lzdGVyZWRDbGFzcykge1xuXHRcdFx0XHRcdG9wdENzc0NsYXNzID0gcmVnaXN0ZXJlZENsYXNzLmNzc0NsYXNzO1xuXHRcdFx0XHR9XG5cdFx0XHR9XG5cblx0XHRcdHZhciBlbGVtZW50cyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy4nICsgb3B0Q3NzQ2xhc3MpO1xuXHRcdFx0Zm9yICh2YXIgbiA9IDA7IG4gPCBlbGVtZW50cy5sZW5ndGg7IG4rKykge1xuXHRcdFx0XHR1cGdyYWRlRWxlbWVudEludGVybmFsKGVsZW1lbnRzW25dLCBqc0NsYXNzKTtcblx0XHRcdH1cblx0XHR9XG5cdH1cblxuXHQvKipcblx0ICogVXBncmFkZXMgYSBzcGVjaWZpYyBlbGVtZW50IHJhdGhlciB0aGFuIGFsbCBpbiB0aGUgRE9NLlxuXHQgKlxuXHQgKiBAcGFyYW0geyFFbGVtZW50fSBlbGVtZW50IFRoZSBlbGVtZW50IHdlIHdpc2ggdG8gdXBncmFkZS5cblx0ICogQHBhcmFtIHtzdHJpbmc9fSBvcHRKc0NsYXNzIE9wdGlvbmFsIG5hbWUgb2YgdGhlIGNsYXNzIHdlIHdhbnQgdG8gdXBncmFkZVxuXHQgKiB0aGUgZWxlbWVudCB0by5cblx0ICovXG5cdGZ1bmN0aW9uIHVwZ3JhZGVFbGVtZW50SW50ZXJuYWwoZWxlbWVudCwgb3B0SnNDbGFzcykge1xuXHRcdC8vIFZlcmlmeSBhcmd1bWVudCB0eXBlLlxuXHRcdGlmICghKHR5cGVvZiBlbGVtZW50ID09PSAnb2JqZWN0JyAmJiBlbGVtZW50IGluc3RhbmNlb2YgRWxlbWVudCkpIHtcblx0XHRcdHRocm93IG5ldyBFcnJvcignSW52YWxpZCBhcmd1bWVudCBwcm92aWRlZCB0byB1cGdyYWRlIE1ETCBlbGVtZW50LicpO1xuXHRcdH1cblx0XHR2YXIgdXBncmFkZWRMaXN0ID0gZ2V0VXBncmFkZWRMaXN0T2ZFbGVtZW50XyhlbGVtZW50KTtcblx0XHR2YXIgY2xhc3Nlc1RvVXBncmFkZSA9IFtdO1xuXHRcdC8vIElmIGpzQ2xhc3MgaXMgbm90IHByb3ZpZGVkIHNjYW4gdGhlIHJlZ2lzdGVyZWQgY29tcG9uZW50cyB0byBmaW5kIHRoZVxuXHRcdC8vIG9uZXMgbWF0Y2hpbmcgdGhlIGVsZW1lbnQncyBDU1MgY2xhc3NMaXN0LlxuXHRcdGlmICghb3B0SnNDbGFzcykge1xuXHRcdFx0dmFyIGNsYXNzTGlzdCA9IGVsZW1lbnQuY2xhc3NMaXN0O1xuXHRcdFx0cmVnaXN0ZXJlZENvbXBvbmVudHNfLmZvckVhY2goZnVuY3Rpb24gKGNvbXBvbmVudCkge1xuXHRcdFx0XHQvLyBNYXRjaCBDU1MgJiBOb3QgdG8gYmUgdXBncmFkZWQgJiBOb3QgdXBncmFkZWQuXG5cdFx0XHRcdGlmIChjbGFzc0xpc3QuY29udGFpbnMoY29tcG9uZW50LmNzc0NsYXNzKSAmJlxuXHRcdFx0XHRcdGNsYXNzZXNUb1VwZ3JhZGUuaW5kZXhPZihjb21wb25lbnQpID09PSAtMSAmJlxuXHRcdFx0XHRcdCFpc0VsZW1lbnRVcGdyYWRlZF8oZWxlbWVudCwgY29tcG9uZW50LmNsYXNzTmFtZSkpIHtcblx0XHRcdFx0XHRjbGFzc2VzVG9VcGdyYWRlLnB1c2goY29tcG9uZW50KTtcblx0XHRcdFx0fVxuXHRcdFx0fSk7XG5cdFx0fSBlbHNlIGlmICghaXNFbGVtZW50VXBncmFkZWRfKGVsZW1lbnQsIG9wdEpzQ2xhc3MpKSB7XG5cdFx0XHRjbGFzc2VzVG9VcGdyYWRlLnB1c2goZmluZFJlZ2lzdGVyZWRDbGFzc18ob3B0SnNDbGFzcykpO1xuXHRcdH1cblxuXHRcdC8vIFVwZ3JhZGUgdGhlIGVsZW1lbnQgZm9yIGVhY2ggY2xhc3Nlcy5cblx0XHRmb3IgKHZhciBpID0gMCwgbiA9IGNsYXNzZXNUb1VwZ3JhZGUubGVuZ3RoLCByZWdpc3RlcmVkQ2xhc3M7IGkgPCBuOyBpKyspIHtcblx0XHRcdHJlZ2lzdGVyZWRDbGFzcyA9IGNsYXNzZXNUb1VwZ3JhZGVbaV07XG5cdFx0XHRpZiAocmVnaXN0ZXJlZENsYXNzKSB7XG5cdFx0XHRcdC8vIE1hcmsgZWxlbWVudCBhcyB1cGdyYWRlZC5cblx0XHRcdFx0dXBncmFkZWRMaXN0LnB1c2gocmVnaXN0ZXJlZENsYXNzLmNsYXNzTmFtZSk7XG5cdFx0XHRcdGVsZW1lbnQuc2V0QXR0cmlidXRlKCdkYXRhLXVwZ3JhZGVkJywgdXBncmFkZWRMaXN0LmpvaW4oJywnKSk7XG5cdFx0XHRcdHZhciBpbnN0YW5jZSA9IG5ldyByZWdpc3RlcmVkQ2xhc3MuY2xhc3NDb25zdHJ1Y3RvcihlbGVtZW50KTtcblx0XHRcdFx0aW5zdGFuY2VbY29tcG9uZW50Q29uZmlnUHJvcGVydHlfXSA9IHJlZ2lzdGVyZWRDbGFzcztcblx0XHRcdFx0Y3JlYXRlZENvbXBvbmVudHNfLnB1c2goaW5zdGFuY2UpO1xuXHRcdFx0XHQvLyBDYWxsIGFueSBjYWxsYmFja3MgdGhlIHVzZXIgaGFzIHJlZ2lzdGVyZWQgd2l0aCB0aGlzIGNvbXBvbmVudCB0eXBlLlxuXHRcdFx0XHRmb3IgKHZhciBqID0gMCwgbSA9IHJlZ2lzdGVyZWRDbGFzcy5jYWxsYmFja3MubGVuZ3RoOyBqIDwgbTsgaisrKSB7XG5cdFx0XHRcdFx0cmVnaXN0ZXJlZENsYXNzLmNhbGxiYWNrc1tqXShlbGVtZW50KTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdGlmIChyZWdpc3RlcmVkQ2xhc3Mud2lkZ2V0KSB7XG5cdFx0XHRcdFx0Ly8gQXNzaWduIHBlciBlbGVtZW50IGluc3RhbmNlIGZvciBjb250cm9sIG92ZXIgQVBJXG5cdFx0XHRcdFx0ZWxlbWVudFtyZWdpc3RlcmVkQ2xhc3MuY2xhc3NOYW1lXSA9IGluc3RhbmNlO1xuXHRcdFx0XHR9XG5cdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHR0aHJvdyBuZXcgRXJyb3IoXG5cdFx0XHRcdFx0J1VuYWJsZSB0byBmaW5kIGEgcmVnaXN0ZXJlZCBjb21wb25lbnQgZm9yIHRoZSBnaXZlbiBjbGFzcy4nKTtcblx0XHRcdH1cblxuXHRcdFx0dmFyIGV2ID0gZG9jdW1lbnQuY3JlYXRlRXZlbnQoJ0V2ZW50cycpO1xuXHRcdFx0ZXYuaW5pdEV2ZW50KCdtZGwtY29tcG9uZW50dXBncmFkZWQnLCB0cnVlLCB0cnVlKTtcblx0XHRcdGVsZW1lbnQuZGlzcGF0Y2hFdmVudChldik7XG5cdFx0fVxuXHR9XG5cblx0LyoqXG5cdCAqIFVwZ3JhZGVzIGEgc3BlY2lmaWMgbGlzdCBvZiBlbGVtZW50cyByYXRoZXIgdGhhbiBhbGwgaW4gdGhlIERPTS5cblx0ICpcblx0ICogQHBhcmFtIHshRWxlbWVudHwhQXJyYXk8IUVsZW1lbnQ+fCFOb2RlTGlzdHwhSFRNTENvbGxlY3Rpb259IGVsZW1lbnRzXG5cdCAqIFRoZSBlbGVtZW50cyB3ZSB3aXNoIHRvIHVwZ3JhZGUuXG5cdCAqL1xuXHRmdW5jdGlvbiB1cGdyYWRlRWxlbWVudHNJbnRlcm5hbChlbGVtZW50cykge1xuXHRcdGlmICghQXJyYXkuaXNBcnJheShlbGVtZW50cykpIHtcblx0XHRcdGlmICh0eXBlb2YgZWxlbWVudHMuaXRlbSA9PT0gJ2Z1bmN0aW9uJykge1xuXHRcdFx0XHRlbGVtZW50cyA9IEFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKChlbGVtZW50cykpO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0ZWxlbWVudHMgPSBbZWxlbWVudHNdO1xuXHRcdFx0fVxuXHRcdH1cblx0XHRmb3IgKHZhciBpID0gMCwgbiA9IGVsZW1lbnRzLmxlbmd0aCwgZWxlbWVudDsgaSA8IG47IGkrKykge1xuXHRcdFx0ZWxlbWVudCA9IGVsZW1lbnRzW2ldO1xuXHRcdFx0aWYgKGVsZW1lbnQgaW5zdGFuY2VvZiBIVE1MRWxlbWVudCkge1xuXHRcdFx0XHR1cGdyYWRlRWxlbWVudEludGVybmFsKGVsZW1lbnQpO1xuXHRcdFx0XHRpZiAoZWxlbWVudC5jaGlsZHJlbi5sZW5ndGggPiAwKSB7XG5cdFx0XHRcdFx0dXBncmFkZUVsZW1lbnRzSW50ZXJuYWwoZWxlbWVudC5jaGlsZHJlbik7XG5cdFx0XHRcdH1cblx0XHRcdH1cblx0XHR9XG5cdH1cblxuXHQvKipcblx0ICogUmVnaXN0ZXJzIGEgY2xhc3MgZm9yIGZ1dHVyZSB1c2UgYW5kIGF0dGVtcHRzIHRvIHVwZ3JhZGUgZXhpc3RpbmcgRE9NLlxuXHQgKlxuXHQgKiBAcGFyYW0ge2NvbXBvbmVudEhhbmRsZXIuQ29tcG9uZW50Q29uZmlnUHVibGljfSBjb25maWdcblx0ICovXG5cdGZ1bmN0aW9uIHJlZ2lzdGVySW50ZXJuYWwoY29uZmlnKSB7XG5cdFx0Ly8gSW4gb3JkZXIgdG8gc3VwcG9ydCBib3RoIENsb3N1cmUtY29tcGlsZWQgYW5kIHVuY29tcGlsZWQgY29kZSBhY2Nlc3Npbmdcblx0XHQvLyB0aGlzIG1ldGhvZCwgd2UgbmVlZCB0byBhbGxvdyBmb3IgYm90aCB0aGUgZG90IGFuZCBhcnJheSBzeW50YXggZm9yXG5cdFx0Ly8gcHJvcGVydHkgYWNjZXNzLiBZb3UnbGwgdGhlcmVmb3JlIHNlZSB0aGUgYGZvby5iYXIgfHwgZm9vWydiYXInXWBcblx0XHQvLyBwYXR0ZXJuIHJlcGVhdGVkIGFjcm9zcyB0aGlzIG1ldGhvZC5cblx0XHR2YXIgd2lkZ2V0TWlzc2luZyA9ICh0eXBlb2YgY29uZmlnLndpZGdldCA9PT0gJ3VuZGVmaW5lZCcgJiZcblx0XHRcdHR5cGVvZiBjb25maWdbJ3dpZGdldCddID09PSAndW5kZWZpbmVkJyk7XG5cdFx0dmFyIHdpZGdldCA9IHRydWU7XG5cblx0XHRpZiAoIXdpZGdldE1pc3NpbmcpIHtcblx0XHRcdHdpZGdldCA9IGNvbmZpZy53aWRnZXQgfHwgY29uZmlnWyd3aWRnZXQnXTtcblx0XHR9XG5cblx0XHR2YXIgbmV3Q29uZmlnID0gKHtcblx0XHRcdGNsYXNzQ29uc3RydWN0b3I6IGNvbmZpZy5jb25zdHJ1Y3RvciB8fCBjb25maWdbJ2NvbnN0cnVjdG9yJ10sXG5cdFx0XHRjbGFzc05hbWU6IGNvbmZpZy5jbGFzc0FzU3RyaW5nIHx8IGNvbmZpZ1snY2xhc3NBc1N0cmluZyddLFxuXHRcdFx0Y3NzQ2xhc3M6IGNvbmZpZy5jc3NDbGFzcyB8fCBjb25maWdbJ2Nzc0NsYXNzJ10sXG5cdFx0XHR3aWRnZXQ6IHdpZGdldCxcblx0XHRcdGNhbGxiYWNrczogW11cblx0XHR9KTtcblxuXHRcdHJlZ2lzdGVyZWRDb21wb25lbnRzXy5mb3JFYWNoKGZ1bmN0aW9uIChpdGVtKSB7XG5cdFx0XHRpZiAoaXRlbS5jc3NDbGFzcyA9PT0gbmV3Q29uZmlnLmNzc0NsYXNzKSB7XG5cdFx0XHRcdHRocm93IG5ldyBFcnJvcignVGhlIHByb3ZpZGVkIGNzc0NsYXNzIGhhcyBhbHJlYWR5IGJlZW4gcmVnaXN0ZXJlZDogJyArIGl0ZW0uY3NzQ2xhc3MpO1xuXHRcdFx0fVxuXHRcdFx0aWYgKGl0ZW0uY2xhc3NOYW1lID09PSBuZXdDb25maWcuY2xhc3NOYW1lKSB7XG5cdFx0XHRcdHRocm93IG5ldyBFcnJvcignVGhlIHByb3ZpZGVkIGNsYXNzTmFtZSBoYXMgYWxyZWFkeSBiZWVuIHJlZ2lzdGVyZWQnKTtcblx0XHRcdH1cblx0XHR9KTtcblxuXHRcdGlmIChjb25maWcuY29uc3RydWN0b3IucHJvdG90eXBlXG5cdFx0XHQuaGFzT3duUHJvcGVydHkoY29tcG9uZW50Q29uZmlnUHJvcGVydHlfKSkge1xuXHRcdFx0dGhyb3cgbmV3IEVycm9yKFxuXHRcdFx0XHQnTURMIGNvbXBvbmVudCBjbGFzc2VzIG11c3Qgbm90IGhhdmUgJyArIGNvbXBvbmVudENvbmZpZ1Byb3BlcnR5XyArXG5cdFx0XHRcdCcgZGVmaW5lZCBhcyBhIHByb3BlcnR5LicpO1xuXHRcdH1cblxuXHRcdHZhciBmb3VuZCA9IGZpbmRSZWdpc3RlcmVkQ2xhc3NfKGNvbmZpZy5jbGFzc0FzU3RyaW5nLCBuZXdDb25maWcpO1xuXG5cdFx0aWYgKCFmb3VuZCkge1xuXHRcdFx0cmVnaXN0ZXJlZENvbXBvbmVudHNfLnB1c2gobmV3Q29uZmlnKTtcblx0XHR9XG5cdH1cblxuXHQvKipcblx0ICogQWxsb3dzIHVzZXIgdG8gYmUgYWxlcnRlZCB0byBhbnkgdXBncmFkZXMgdGhhdCBhcmUgcGVyZm9ybWVkIGZvciBhIGdpdmVuXG5cdCAqIGNvbXBvbmVudCB0eXBlXG5cdCAqXG5cdCAqIEBwYXJhbSB7c3RyaW5nfSBqc0NsYXNzIFRoZSBjbGFzcyBuYW1lIG9mIHRoZSBNREwgY29tcG9uZW50IHdlIHdpc2hcblx0ICogdG8gaG9vayBpbnRvIGZvciBhbnkgdXBncmFkZXMgcGVyZm9ybWVkLlxuXHQgKiBAcGFyYW0ge2Z1bmN0aW9uKCFIVE1MRWxlbWVudCl9IGNhbGxiYWNrIFRoZSBmdW5jdGlvbiB0byBjYWxsIHVwb24gYW5cblx0ICogdXBncmFkZS4gVGhpcyBmdW5jdGlvbiBzaG91bGQgZXhwZWN0IDEgcGFyYW1ldGVyIC0gdGhlIEhUTUxFbGVtZW50IHdoaWNoXG5cdCAqIGdvdCB1cGdyYWRlZC5cblx0ICovXG5cdGZ1bmN0aW9uIHJlZ2lzdGVyVXBncmFkZWRDYWxsYmFja0ludGVybmFsKGpzQ2xhc3MsIGNhbGxiYWNrKSB7XG5cdFx0dmFyIHJlZ0NsYXNzID0gZmluZFJlZ2lzdGVyZWRDbGFzc18oanNDbGFzcyk7XG5cdFx0aWYgKHJlZ0NsYXNzKSB7XG5cdFx0XHRyZWdDbGFzcy5jYWxsYmFja3MucHVzaChjYWxsYmFjayk7XG5cdFx0fVxuXHR9XG5cblx0LyoqXG5cdCAqIFVwZ3JhZGVzIGFsbCByZWdpc3RlcmVkIGNvbXBvbmVudHMgZm91bmQgaW4gdGhlIGN1cnJlbnQgRE9NLiBUaGlzIGlzXG5cdCAqIGF1dG9tYXRpY2FsbHkgY2FsbGVkIG9uIHdpbmRvdyBsb2FkLlxuXHQgKi9cblx0ZnVuY3Rpb24gdXBncmFkZUFsbFJlZ2lzdGVyZWRJbnRlcm5hbCgpIHtcblx0XHRmb3IgKHZhciBuID0gMDsgbiA8IHJlZ2lzdGVyZWRDb21wb25lbnRzXy5sZW5ndGg7IG4rKykge1xuXHRcdFx0dXBncmFkZURvbUludGVybmFsKHJlZ2lzdGVyZWRDb21wb25lbnRzX1tuXS5jbGFzc05hbWUpO1xuXHRcdH1cblx0fVxuXG5cdC8qKlxuXHQgKiBGaW5kcyBhIGNyZWF0ZWQgY29tcG9uZW50IGJ5IGEgZ2l2ZW4gRE9NIG5vZGUuXG5cdCAqXG5cdCAqIEBwYXJhbSB7IU5vZGV9IG5vZGVcblx0ICogQHJldHVybiB7P2NvbXBvbmVudEhhbmRsZXIuQ29tcG9uZW50fVxuXHQgKi9cblx0ZnVuY3Rpb24gZmluZENyZWF0ZWRDb21wb25lbnRCeU5vZGVJbnRlcm5hbChub2RlKSB7XG5cdFx0Zm9yICh2YXIgbiA9IDA7IG4gPCBjcmVhdGVkQ29tcG9uZW50c18ubGVuZ3RoOyBuKyspIHtcblx0XHRcdHZhciBjb21wb25lbnQgPSBjcmVhdGVkQ29tcG9uZW50c19bbl07XG5cdFx0XHRpZiAoY29tcG9uZW50LmVsZW1lbnRfID09PSBub2RlKSB7XG5cdFx0XHRcdHJldHVybiBjb21wb25lbnQ7XG5cdFx0XHR9XG5cdFx0fVxuXHRcdHJldHVybiBudWxsO1xuXHR9XG5cblx0LyoqXG5cdCAqIENoZWNrIHRoZSBjb21wb25lbnQgZm9yIHRoZSBkb3duZ3JhZGUgbWV0aG9kLlxuXHQgKiBFeGVjdXRlIGlmIGZvdW5kLlxuXHQgKiBSZW1vdmUgY29tcG9uZW50IGZyb20gY3JlYXRlZENvbXBvbmVudHMgbGlzdC5cblx0ICpcblx0ICogQHBhcmFtIHs/Y29tcG9uZW50SGFuZGxlci5Db21wb25lbnR9IGNvbXBvbmVudFxuXHQgKi9cblx0ZnVuY3Rpb24gZGVjb25zdHJ1Y3RDb21wb25lbnRJbnRlcm5hbChjb21wb25lbnQpIHtcblx0XHRpZiAoY29tcG9uZW50ICYmXG5cdFx0XHRjb21wb25lbnRbY29tcG9uZW50Q29uZmlnUHJvcGVydHlfXVxuXHRcdFx0LmNsYXNzQ29uc3RydWN0b3IucHJvdG90eXBlXG5cdFx0XHQuaGFzT3duUHJvcGVydHkoZG93bmdyYWRlTWV0aG9kXykpIHtcblx0XHRcdGNvbXBvbmVudFtkb3duZ3JhZGVNZXRob2RfXSgpO1xuXHRcdFx0dmFyIGNvbXBvbmVudEluZGV4ID0gY3JlYXRlZENvbXBvbmVudHNfLmluZGV4T2YoY29tcG9uZW50KTtcblx0XHRcdGNyZWF0ZWRDb21wb25lbnRzXy5zcGxpY2UoY29tcG9uZW50SW5kZXgsIDEpO1xuXG5cdFx0XHR2YXIgdXBncmFkZXMgPSBjb21wb25lbnQuZWxlbWVudF8uZ2V0QXR0cmlidXRlKCdkYXRhLXVwZ3JhZGVkJykuc3BsaXQoJywnKTtcblx0XHRcdHZhciBjb21wb25lbnRQbGFjZSA9IHVwZ3JhZGVzLmluZGV4T2YoXG5cdFx0XHRcdGNvbXBvbmVudFtjb21wb25lbnRDb25maWdQcm9wZXJ0eV9dLmNsYXNzQXNTdHJpbmcpO1xuXHRcdFx0dXBncmFkZXMuc3BsaWNlKGNvbXBvbmVudFBsYWNlLCAxKTtcblx0XHRcdGNvbXBvbmVudC5lbGVtZW50Xy5zZXRBdHRyaWJ1dGUoJ2RhdGEtdXBncmFkZWQnLCB1cGdyYWRlcy5qb2luKCcsJykpO1xuXG5cdFx0XHR2YXIgZXYgPSBkb2N1bWVudC5jcmVhdGVFdmVudCgnRXZlbnRzJyk7XG5cdFx0XHRldi5pbml0RXZlbnQoJ21kbC1jb21wb25lbnRkb3duZ3JhZGVkJywgdHJ1ZSwgdHJ1ZSk7XG5cdFx0XHRjb21wb25lbnQuZWxlbWVudF8uZGlzcGF0Y2hFdmVudChldik7XG5cdFx0fVxuXHR9XG5cblx0LyoqXG5cdCAqIERvd25ncmFkZSBlaXRoZXIgYSBnaXZlbiBub2RlLCBhbiBhcnJheSBvZiBub2Rlcywgb3IgYSBOb2RlTGlzdC5cblx0ICpcblx0ICogQHBhcmFtIHshTm9kZXwhQXJyYXk8IU5vZGU+fCFOb2RlTGlzdH0gbm9kZXNcblx0ICovXG5cdGZ1bmN0aW9uIGRvd25ncmFkZU5vZGVzSW50ZXJuYWwobm9kZXMpIHtcblx0XHQvKipcblx0XHQgKiBBdXhpbGlhcnkgZnVuY3Rpb24gdG8gZG93bmdyYWRlIGEgc2luZ2xlIG5vZGUuXG5cdFx0ICogQHBhcmFtICB7IU5vZGV9IG5vZGUgdGhlIG5vZGUgdG8gYmUgZG93bmdyYWRlZFxuXHRcdCAqL1xuXHRcdHZhciBkb3duZ3JhZGVOb2RlID0gZnVuY3Rpb24gKG5vZGUpIHtcblx0XHRcdGRlY29uc3RydWN0Q29tcG9uZW50SW50ZXJuYWwoZmluZENyZWF0ZWRDb21wb25lbnRCeU5vZGVJbnRlcm5hbChub2RlKSk7XG5cdFx0fTtcblx0XHRpZiAobm9kZXMgaW5zdGFuY2VvZiBBcnJheSB8fCBub2RlcyBpbnN0YW5jZW9mIE5vZGVMaXN0KSB7XG5cdFx0XHRmb3IgKHZhciBuID0gMDsgbiA8IG5vZGVzLmxlbmd0aDsgbisrKSB7XG5cdFx0XHRcdGRvd25ncmFkZU5vZGUobm9kZXNbbl0pO1xuXHRcdFx0fVxuXHRcdH0gZWxzZSBpZiAobm9kZXMgaW5zdGFuY2VvZiBOb2RlKSB7XG5cdFx0XHRkb3duZ3JhZGVOb2RlKG5vZGVzKTtcblx0XHR9IGVsc2Uge1xuXHRcdFx0dGhyb3cgbmV3IEVycm9yKCdJbnZhbGlkIGFyZ3VtZW50IHByb3ZpZGVkIHRvIGRvd25ncmFkZSBNREwgbm9kZXMuJyk7XG5cdFx0fVxuXHR9XG5cblx0Ly8gTm93IHJldHVybiB0aGUgZnVuY3Rpb25zIHRoYXQgc2hvdWxkIGJlIG1hZGUgcHVibGljIHdpdGggdGhlaXIgcHVibGljbHlcblx0Ly8gZmFjaW5nIG5hbWVzLi4uXG5cdHJldHVybiB7XG5cdFx0dXBncmFkZURvbTogdXBncmFkZURvbUludGVybmFsLFxuXHRcdHVwZ3JhZGVFbGVtZW50OiB1cGdyYWRlRWxlbWVudEludGVybmFsLFxuXHRcdHVwZ3JhZGVFbGVtZW50czogdXBncmFkZUVsZW1lbnRzSW50ZXJuYWwsXG5cdFx0dXBncmFkZUFsbFJlZ2lzdGVyZWQ6IHVwZ3JhZGVBbGxSZWdpc3RlcmVkSW50ZXJuYWwsXG5cdFx0cmVnaXN0ZXJVcGdyYWRlZENhbGxiYWNrOiByZWdpc3RlclVwZ3JhZGVkQ2FsbGJhY2tJbnRlcm5hbCxcblx0XHRyZWdpc3RlcjogcmVnaXN0ZXJJbnRlcm5hbCxcblx0XHRkb3duZ3JhZGVFbGVtZW50czogZG93bmdyYWRlTm9kZXNJbnRlcm5hbFxuXHR9O1xufSkoKTtcblxuLyoqXG4gKiBEZXNjcmliZXMgdGhlIHR5cGUgb2YgYSByZWdpc3RlcmVkIGNvbXBvbmVudCB0eXBlIG1hbmFnZWQgYnlcbiAqIGNvbXBvbmVudEhhbmRsZXIuIFByb3ZpZGVkIGZvciBiZW5lZml0IG9mIHRoZSBDbG9zdXJlIGNvbXBpbGVyLlxuICpcbiAqIEB0eXBlZGVmIHt7XG4gKiAgIGNvbnN0cnVjdG9yOiBGdW5jdGlvbixcbiAqICAgY2xhc3NBc1N0cmluZzogc3RyaW5nLFxuICogICBjc3NDbGFzczogc3RyaW5nLFxuICogICB3aWRnZXQ6IChzdHJpbmd8Ym9vbGVhbnx1bmRlZmluZWQpXG4gKiB9fVxuICovXG5jb21wb25lbnRIYW5kbGVyLkNvbXBvbmVudENvbmZpZ1B1YmxpYzsgLy8ganNoaW50IGlnbm9yZTpsaW5lXG5cbi8qKlxuICogRGVzY3JpYmVzIHRoZSB0eXBlIG9mIGEgcmVnaXN0ZXJlZCBjb21wb25lbnQgdHlwZSBtYW5hZ2VkIGJ5XG4gKiBjb21wb25lbnRIYW5kbGVyLiBQcm92aWRlZCBmb3IgYmVuZWZpdCBvZiB0aGUgQ2xvc3VyZSBjb21waWxlci5cbiAqXG4gKiBAdHlwZWRlZiB7e1xuICogICBjb25zdHJ1Y3RvcjogIUZ1bmN0aW9uLFxuICogICBjbGFzc05hbWU6IHN0cmluZyxcbiAqICAgY3NzQ2xhc3M6IHN0cmluZyxcbiAqICAgd2lkZ2V0OiAoc3RyaW5nfGJvb2xlYW4pLFxuICogICBjYWxsYmFja3M6ICFBcnJheTxmdW5jdGlvbighSFRNTEVsZW1lbnQpPlxuICogfX1cbiAqL1xuY29tcG9uZW50SGFuZGxlci5Db21wb25lbnRDb25maWc7IC8vIGpzaGludCBpZ25vcmU6bGluZVxuXG4vKipcbiAqIENyZWF0ZWQgY29tcG9uZW50IChpLmUuLCB1cGdyYWRlZCBlbGVtZW50KSB0eXBlIGFzIG1hbmFnZWQgYnlcbiAqIGNvbXBvbmVudEhhbmRsZXIuIFByb3ZpZGVkIGZvciBiZW5lZml0IG9mIHRoZSBDbG9zdXJlIGNvbXBpbGVyLlxuICpcbiAqIEB0eXBlZGVmIHt7XG4gKiAgIGVsZW1lbnRfOiAhSFRNTEVsZW1lbnQsXG4gKiAgIGNsYXNzTmFtZTogc3RyaW5nLFxuICogICBjbGFzc0FzU3RyaW5nOiBzdHJpbmcsXG4gKiAgIGNzc0NsYXNzOiBzdHJpbmcsXG4gKiAgIHdpZGdldDogc3RyaW5nXG4gKiB9fVxuICovXG5jb21wb25lbnRIYW5kbGVyLkNvbXBvbmVudDsgLy8ganNoaW50IGlnbm9yZTpsaW5lXG5cbi8vIEV4cG9ydCBhbGwgc3ltYm9scywgZm9yIHRoZSBiZW5lZml0IG9mIENsb3N1cmUgY29tcGlsZXIuXG4vLyBObyBlZmZlY3Qgb24gdW5jb21waWxlZCBjb2RlLlxuY29tcG9uZW50SGFuZGxlclsndXBncmFkZURvbSddID0gY29tcG9uZW50SGFuZGxlci51cGdyYWRlRG9tO1xuY29tcG9uZW50SGFuZGxlclsndXBncmFkZUVsZW1lbnQnXSA9IGNvbXBvbmVudEhhbmRsZXIudXBncmFkZUVsZW1lbnQ7XG5jb21wb25lbnRIYW5kbGVyWyd1cGdyYWRlRWxlbWVudHMnXSA9IGNvbXBvbmVudEhhbmRsZXIudXBncmFkZUVsZW1lbnRzO1xuY29tcG9uZW50SGFuZGxlclsndXBncmFkZUFsbFJlZ2lzdGVyZWQnXSA9XG5cdGNvbXBvbmVudEhhbmRsZXIudXBncmFkZUFsbFJlZ2lzdGVyZWQ7XG5jb21wb25lbnRIYW5kbGVyWydyZWdpc3RlclVwZ3JhZGVkQ2FsbGJhY2snXSA9XG5cdGNvbXBvbmVudEhhbmRsZXIucmVnaXN0ZXJVcGdyYWRlZENhbGxiYWNrO1xuY29tcG9uZW50SGFuZGxlclsncmVnaXN0ZXInXSA9IGNvbXBvbmVudEhhbmRsZXIucmVnaXN0ZXI7XG5jb21wb25lbnRIYW5kbGVyWydkb3duZ3JhZGVFbGVtZW50cyddID0gY29tcG9uZW50SGFuZGxlci5kb3duZ3JhZGVFbGVtZW50cztcbndpbmRvdy5jb21wb25lbnRIYW5kbGVyID0gY29tcG9uZW50SGFuZGxlcjtcbndpbmRvd1snY29tcG9uZW50SGFuZGxlciddID0gY29tcG9uZW50SGFuZGxlcjtcblxud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2xvYWQnLCBmdW5jdGlvbiAoKSB7XG5cdCd1c2Ugc3RyaWN0JztcblxuXHQvKipcblx0ICogUGVyZm9ybXMgYSBcIkN1dHRpbmcgdGhlIG11c3RhcmRcIiB0ZXN0LiBJZiB0aGUgYnJvd3NlciBzdXBwb3J0cyB0aGUgZmVhdHVyZXNcblx0ICogdGVzdGVkLCBhZGRzIGEgbWRsLWpzIGNsYXNzIHRvIHRoZSA8aHRtbD4gZWxlbWVudC4gSXQgdGhlbiB1cGdyYWRlcyBhbGwgTURMXG5cdCAqIGNvbXBvbmVudHMgcmVxdWlyaW5nIEphdmFTY3JpcHQuXG5cdCAqL1xuXHRpZiAoJ2NsYXNzTGlzdCcgaW4gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2JykgJiZcblx0XHQncXVlcnlTZWxlY3RvcicgaW4gZG9jdW1lbnQgJiZcblx0XHQnYWRkRXZlbnRMaXN0ZW5lcicgaW4gd2luZG93ICYmIEFycmF5LnByb3RvdHlwZS5mb3JFYWNoKSB7XG5cdFx0ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmNsYXNzTGlzdC5hZGQoJ21kbC1qcycpO1xuXHRcdGNvbXBvbmVudEhhbmRsZXIudXBncmFkZUFsbFJlZ2lzdGVyZWQoKTtcblx0fSBlbHNlIHtcblx0XHQvKipcblx0XHQgKiBEdW1teSBmdW5jdGlvbiB0byBhdm9pZCBKUyBlcnJvcnMuXG5cdFx0ICovXG5cdFx0Y29tcG9uZW50SGFuZGxlci51cGdyYWRlRWxlbWVudCA9IGZ1bmN0aW9uICgpIHt9O1xuXHRcdC8qKlxuXHRcdCAqIER1bW15IGZ1bmN0aW9uIHRvIGF2b2lkIEpTIGVycm9ycy5cblx0XHQgKi9cblx0XHRjb21wb25lbnRIYW5kbGVyLnJlZ2lzdGVyID0gZnVuY3Rpb24gKCkge307XG5cdH1cbn0pO1xuIl0sImZpbGUiOiJtZGxDb21wb25lbnRIYW5kbGVyLmpzIiwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=


//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIiJdLCJmaWxlIjoibWFpbi5qcyIsInNvdXJjZVJvb3QiOiIvc291cmNlLyJ9
