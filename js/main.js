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
    if (event.target.nodeName === 'A' || event.target.nodeName === 'LI') {
      closeMenu();
    }
  });
})();

(function () {
  'use strict';

	var querySelector = document.querySelector.bind(document);
	var dropdownMenu = document.querySelector('.dropdown-menu').nextSibling;
	var dropBtn = querySelector('.dropdown-toggle');
	var main = querySelector('.main-container');

	  function closeDrop() {
    dropdownMenu.classList.remove('expanded');
    dropdownMenu.classList.add('collapsed');
  }

	  function toggleDrop() {
    dropdownMenu.classList.toggle('expanded');
  }

  main.addEventListener('click', closeDrop);
  dropBtn.addEventListener('click', toggleDrop);
  dropdownMenu.addEventListener('click', function (event) {
    if (event.target.nodeName === 'A' || event.target.nodeName === 'LI') {
      closeDrop();
    }
  });


