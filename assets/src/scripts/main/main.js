
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
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

(function () {
  'use strict';

  var querySelector = document.querySelector.bind(document);

  var navdrawerContainer = querySelector('.menu-primary');
  var body = document.body;
  var menuBtn = querySelector('.menu-toggle');
  var navdrawerOverlay = querySelector('.layout__obfuscator');

  function closeMenu() {
    body.classList.remove('is-visible');
    navdrawerOverlay.classList.remove('is-visible');
    navdrawerContainer.classList.remove('is-visible');
  }

  function toggleMenu() {
    body.classList.toggle('is-visible');
    navdrawerOverlay.classList.toggle('is-visible');
    navdrawerContainer.classList.toggle('is-visible');
  }

  navdrawerOverlay.addEventListener('click', closeMenu);
  menuBtn.addEventListener('click', toggleMenu);
  // navdrawerContainer.addEventListener('click', function (event) {
  //   if (event.target.nodeName === 'A' || event.target.nodeName === 'LI') {
  //     closeMenu();
  //   }
  // });
})();







// grab an element
var headerBar = document.querySelector(".site-header");
// construct an instance of Headroom, passing the element
var headroom  = new Headroom(headerBar, {
    // vertical offset in px before element is first unpinned
    offset : 60,
    // scroll tolerance in px before state changes
    //tolerance : 0,
    // or you can specify tolerance individually for up/down scroll
    tolerance : {
        up : 5,
        down : 40
    },
    // css classes to apply
    classes : {
        // when element is initialised
        initial : "header",
        // when scrolling up
        pinned : "header--pinned",
        // when scrolling down
        unpinned : "header--unpinned",
        // when above offset
        top : "header--top",
        // when below offset
        notTop : "header--not-top"
    },
});
headroom.init();
