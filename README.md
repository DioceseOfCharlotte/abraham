# Abraham Wordpress Theme

This theme is very much still a **WIP** so it **CHANGES OFTEN** and **THINGS MAY BREAK**.
Abraham is being built as a parent theme to house several functions and plugins which can be called from a child theme.
Opinionated styles are kept to a minimum which give child themes a bit more freedom with their designs. This also makes Abraham a great starter theme.


## What's included?
1. [Hybrid Core](http://themehybrid.com/hybrid-core)
2. Gulp with [BrowserSync](https://github.com/shakyShane/browser-sync)
3. SASS with BEM-like structure based on Harry Roberts' [CSS Guidelines](http://cssguidelin.es/)
4. Advanced development features and best practices borrowed from Google’s [Web Starter Kit](https://developers.google.com/web/starter-kit/) including:
  * Multi-device responsive boilerplate
  * Cross-device Synchronization
  * Live Browser Reloading
  * Performance optimization
  * Built in HTTP Server

## Getting Started
You'll need the following dependencies installed to take advantage of the development tools.

* [Node.js](https://nodejs.org)
* [gulp.js](http://gulpjs.com)
* [Sass](http://sass-lang.com/install)

I use [Varying Vagrant Vagrants](https://github.com/Varying-Vagrant-Vagrants/VVV) to run my local WordPress. This isn't necessary for this theme but the Gulp file is configured for it so if you're environment is different you'll need to edit the file accordingly.


Open a terminal in your themes folder.
If you're using VVV, that would most likely be:
```sh
$ cd vagrant-local/www/wordpress-default/wp-content/themes
```
clone the repository:
```sh
$ git clone https://github.com/m-e-h/abraham.git
```
go to the theme folder in your terminal:
```sh
$ cd abraham
```
install the dependencies: *you may or may not need the 'sudo'*
```sh
$ sudo npm install
```
launch the server and watch everything get compiled in real time, as changes are made:
```sh
$ gulp serve
```
