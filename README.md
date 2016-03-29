[![devDependency Status](https://david-dm.org/m-e-h/abraham/dev-status.svg)](https://david-dm.org/m-e-h/abraham#info=devDependencies)
# Abraham Wordpress Theme

This theme is very much still a **WIP** so it **CHANGES OFTEN** and **THINGS MAY BREAK**.
Abraham is being built as a parent theme to house several functions and plugins which can be called from a child theme.
Opinionated styles are kept to a minimum which give child themes a bit more freedom with their designs. This also makes Abraham a great starter theme.



#### Additional libraries for advanced Wordpress theming.
- Advanced theming functions and solid child theme support via [Hybrid Core](http://themehybrid.com/hybrid-core)
- Action hooks via [Theme Hook Alliance](https://github.com/zamoose/themehookalliance)

## Getting Started
You'll need the following dependencies installed to take advantage of the development tools.

* [Node.js](https://nodejs.org)
* [gulp.js](http://gulpjs.com)
* [Composer](https://getcomposer.org) *installed [globally](https://getcomposer.org/doc/00-intro.md#globally)*

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
install the required node packages: *may need to add 'sudo' before this command*
```sh
$ npm install
```
fetch the required projects from Composer:
```sh
$ composer install
```
Compile and optimize the files:
```sh
$ gulp
```
launch the server and watch everything get compiled in real time, as changes are made:
```sh
$ gulp serve
```
