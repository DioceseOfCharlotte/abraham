/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

(function () {
  'use strict';

  var querySelector = document.querySelector.bind(document);

  var navdrawerContainer = querySelector('.menu');
  var body = document.body;
  var appbarElement = querySelector('#header');
  var menuBtn = querySelector('.menu-toggle');
  var main = querySelector('.main-container');
  var footer = querySelector('.site-footer');

  function closeMenu() {
    body.classList.remove('is-open');
    appbarElement.classList.remove('is-open');
    navdrawerContainer.classList.remove('is-open');
  }

  function toggleMenu() {
    body.classList.toggle('is-open');
    appbarElement.classList.toggle('is-open');
    navdrawerContainer.classList.toggle('is-open');
    navdrawerContainer.classList.add('has-opened');
  }

  footer.addEventListener('click', closeMenu);
  main.addEventListener('click', closeMenu);
  menuBtn.addEventListener('click', toggleMenu);
  // navdrawerContainer.addEventListener('click', function (event) {
  //   if (event.target.nodeName === 'A' || event.target.nodeName === 'LI') {
  //     closeMenu();
  //   }
  // });
})();
