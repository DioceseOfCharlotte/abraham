"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function e(e,t){for(var i=0;i<t.length;i++){var s=t[i];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(e,s.key,s)}}return function(t,i,s){return i&&e(t.prototype,i),s&&e(t,s),t}}(),Detabinator=function(){function e(t){if(_classCallCheck(this,e),!t)throw new Error("Missing required argument. new Detabinator needs an element reference");this._inert=!1,this._focusableElementsString="a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex], [contenteditable]",this._focusableElements=Array.from(t.querySelectorAll(this._focusableElementsString))}return _createClass(e,[{key:"inert",get:function(){return this._inert},set:function(e){this._inert!==e&&(this._inert=e,this._focusableElements.forEach(function(t){if(e)t.hasAttribute("tabindex")&&(t.__savedTabindex=t.tabIndex),t.setAttribute("tabindex",-1);else{if(0===t.__savedTabindex||t.__savedTabindex)return t.setAttribute("tabindex",t.__savedTabindex);t.removeAttribute("tabindex")}}))}}]),e}();!function(){function e(){for(var e=this;-1===e.className.indexOf("nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}var t,i,s,n,a,r,o;if(t=document.getElementById("menu-primary"),t&&(i=t.getElementsByTagName("button")[0],"undefined"!=typeof i)){if(s=t.getElementsByTagName("ul")[0],"undefined"==typeof s)return void(i.style.display="none");for(s.setAttribute("aria-expanded","false"),-1===s.className.indexOf("nav-menu")&&(s.className+=" nav-menu"),i.onclick=function(){-1!==t.className.indexOf("toggled")?(t.className=t.className.replace(" toggled",""),i.setAttribute("aria-expanded","false"),s.setAttribute("aria-expanded","false")):(t.className+=" toggled",i.setAttribute("aria-expanded","true"),s.setAttribute("aria-expanded","true"))},n=s.getElementsByTagName("a"),a=s.getElementsByTagName("ul"),r=0,o=a.length;r<o;r++)a[r].parentNode.setAttribute("aria-haspopup","true");for(r=0,o=n.length;r<o;r++)n[r].addEventListener("focus",e,!0),n[r].addEventListener("blur",e,!0);!function(e){var t,i,s=e.querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a");if("ontouchstart"in window)for(t=function(e){var t,i=this.parentNode;if(i.classList.contains("focus"))i.classList.remove("focus");else{for(e.preventDefault(),t=0;t<i.parentNode.children.length;++t)i!==i.parentNode.children[t]&&i.parentNode.children[t].classList.remove("focus");i.classList.add("focus")}},i=0;i<s.length;++i)s[i].addEventListener("touchstart",t,!1)}(t)}}();var _createClass=function(){function e(e,t){for(var i=0;i<t.length;i++){var s=t[i];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(e,s.key,s)}}return function(t,i,s){return i&&e(t.prototype,i),s&&e(t,s),t}}(),SideNav=function(){function e(){_classCallCheck(this,e),this.body=document.body,this.showButtonEl=document.querySelector(".js-menu-show"),this.hideButtonEl=document.querySelector(".js-menu-hide"),this.sideNavEl=document.querySelector(".js-side-nav"),this.sideNavContainerEl=document.querySelector(".js-side-nav-container"),this.detabinator=new Detabinator(this.sideNavContainerEl),this.detabinator.inert=!0,this.showSideNav=this.showSideNav.bind(this),this.hideSideNav=this.hideSideNav.bind(this),this.blockClicks=this.blockClicks.bind(this),this.onTouchStart=this.onTouchStart.bind(this),this.onTouchMove=this.onTouchMove.bind(this),this.onTouchEnd=this.onTouchEnd.bind(this),this.onTransitionEnd=this.onTransitionEnd.bind(this),this.update=this.update.bind(this),this.startX=0,this.currentX=0,this.touchingSideNav=!1,this.supportsPassive=void 0,this.addEventListeners()}return _createClass(e,[{key:"applyPassive",value:function(){if(void 0!==this.supportsPassive)return!!this.supportsPassive&&{passive:!0};var e=!1;try{document.addEventListener("test",null,{get passive(){e=!0}})}catch(e){}return this.supportsPassive=e,this.applyPassive()}},{key:"addEventListeners",value:function(){this.showButtonEl.addEventListener("click",this.showSideNav),this.hideButtonEl.addEventListener("click",this.hideSideNav),this.sideNavEl.addEventListener("click",this.hideSideNav),this.sideNavContainerEl.addEventListener("click",this.blockClicks),this.sideNavEl.addEventListener("touchstart",this.onTouchStart,this.applyPassive()),this.sideNavEl.addEventListener("touchmove",this.onTouchMove,this.applyPassive()),this.sideNavEl.addEventListener("touchend",this.onTouchEnd)}},{key:"onTouchStart",value:function(e){this.sideNavEl.classList.contains("side-nav--visible")&&(this.startX=e.touches[0].pageX,this.currentX=this.startX,this.touchingSideNav=!0,requestAnimationFrame(this.update))}},{key:"onTouchMove",value:function(e){this.touchingSideNav&&(this.currentX=e.touches[0].pageX)}},{key:"onTouchEnd",value:function(e){if(this.touchingSideNav){this.touchingSideNav=!1;var t=Math.min(0,this.currentX-this.startX);this.sideNavContainerEl.style.transform="",t<-100&&this.hideSideNav()}}},{key:"update",value:function(){if(this.touchingSideNav){requestAnimationFrame(this.update);var e=Math.min(0,this.currentX-this.startX);this.sideNavContainerEl.style.transform="translateX("+e+"px)"}}},{key:"blockClicks",value:function(e){e.stopPropagation()}},{key:"onTransitionEnd",value:function(e){this.sideNavEl.classList.remove("side-nav--animatable"),this.sideNavEl.removeEventListener("transitionend",this.onTransitionEnd)}},{key:"showSideNav",value:function(){this.body.classList.add("u-overflow-hidden"),this.sideNavEl.classList.add("side-nav--animatable"),this.sideNavEl.classList.add("side-nav--visible"),this.detabinator.inert=!1,this.sideNavEl.addEventListener("transitionend",this.onTransitionEnd)}},{key:"hideSideNav",value:function(){this.body.classList.remove("u-overflow-hidden"),this.sideNavEl.classList.add("side-nav--animatable"),this.sideNavEl.classList.remove("side-nav--visible"),this.detabinator.inert=!0,this.sideNavEl.addEventListener("transitionend",this.onTransitionEnd)}}]),e}();new SideNav;