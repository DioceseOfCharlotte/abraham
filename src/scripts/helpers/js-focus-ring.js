var jsFocusRing = (function(scope) {
	scope = scope || window;

	const inputTypesWhitelist = {
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

	let keyboardThrottleTimeoutID;

	scope.addEventListener(
		"blur",
		event => {
			if (event.target instanceof Element) {
				event.target.removeAttribute("js-focus");
				event.target.removeAttribute("js-focus-ring");
			}
		},
		true
	);

	scope.addEventListener(
		"focus",
		event => {
			const activeElement = document.activeElement;

			if (
				activeElement instanceof Element &&
				"BODY" !== activeElement.tagName
			) {
				activeElement.setAttribute("js-focus", "");

				if (
					keyboardThrottleTimeoutID ||
					scope === event.target ||
					("INPUT" === activeElement.tagName &&
						inputTypesWhitelist[activeElement.type] &&
						!activeElement.readonly) ||
					("TEXTAREA" === activeElement.tagName &&
						!activeElement.readonly) ||
					"true" === activeElement.contentEditable
				) {
					activeElement.setAttribute("js-focus-ring", "");
				}
			}
		},
		true
	);

	scope.addEventListener(
		"keydown",
		() => {
			keyboardThrottleTimeoutID =
				clearTimeout(keyboardThrottleTimeoutID) ||
				setTimeout(() => {
					keyboardThrottleTimeoutID = 0;
				}, 100);
		},
		true
	);
})();
