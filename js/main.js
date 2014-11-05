/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
(function () {
  'use strict';


  var querySelector = document.querySelector.bind(document);

  var navdrawerContainer = querySelector('.navdrawer');
  var body = document.body;
  var appbarElement = querySelector('.app-bar');
  var menuBtn = querySelector('.navdrawer__toggle');
  var main = querySelector('.main-container');

  function closeMenu() {
    body.classList.remove('open');
    appbarElement.classList.remove('open');
    navdrawerContainer.classList.remove('open');
  }

  function toggleMenu() {
    body.classList.toggle('open');
    appbarElement.classList.toggle('open');
    navdrawerContainer.classList.toggle('open');
    navdrawerContainer.classList.add('opened');
  }

  main.addEventListener('click', closeMenu);
  menuBtn.addEventListener('click', toggleMenu);
  navdrawerContainer.addEventListener('click', function (event) {
  });
})();

    	document.querySelector('.menu-item-has-children').classList.add('dropdown-basic');
    	document.querySelector('.menu-item-has-children').dataset.dropdown = "";

    	document.querySelector('.sub-menu').classList.add('dropdown-menu-basic');
    	document.querySelector('.sub-menu').dataset.dropdown = "";