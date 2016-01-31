/**
 * MEH gulp
 */

// 'use strict';

var gulp = require('gulp');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var gulpLoadPlugins = require('gulp-load-plugins');
var postcss = require('gulp-postcss');
var babel = require('gulp-babel');
var xo = require('gulp-xo');
var autoPrefixer = require('autoprefixer');
var postcssFlex = require('postcss-flexibility');
// var postcssScss = require('postcss-scss');
// var postcssNested = require('postcss-nested');
// var precss = require('precss');

var $ = gulpLoadPlugins();
var reload = browserSync.reload;

var AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'last 2 ff versions',
	'last 2 chrome versions',
	'last 2 edge versions',
	'last 2 safari versions',
	'last 2 opera versions',
	'ios >= 7',
	'android >= 4.4',
	'bb >= 10'
];

var POSTCSS_PLUGINS = [
	autoPrefixer({
		browsers: AUTOPREFIXER_BROWSERS
	}),
	postcssFlex
	// postcssNested
	// colorFunction,
	// precss,
];

var SOURCESJS = [
	'assets/src/scripts/main.js'
];

// Scripts that rely on jQuery
var SOURCESJQ = [
	'assets/src/scripts/jq-main.js'
];

// ***** Development tasks ****** //
// Lint JavaScript
gulp.task('lint', function () {
	gulp.src('assets/src/scripts/*.js')
	.pipe(xo())
});

// ***** Production build tasks ****** //
// Optimize images
gulp.task('images', function () {
	gulp.src('assets/src/images/**/*.{svg,png,jpg}')
	.pipe($.cache($.imagemin({
		progressive: true,
		interlaced: true
	})))
	.pipe(gulp.dest('assets/images'))
	.pipe($.size({
		title: 'images'
	}))
});

// Compile and Automatically Prefix Stylesheets (production)
gulp.task('styles', function () {
	gulp.src('assets/src/styles/style.scss')
		.pipe($.sourcemaps.init())
		.pipe($.sass({
			precision: 10,
			onError: console.error.bind(console, 'Sass error:')
		}))
		.pipe(postcss(POSTCSS_PLUGINS))
		.pipe(gulp.dest('.tmp'))
		.pipe($.concat('style.css'))
		.pipe(gulp.dest('./'))
		.pipe($.if('*.css', $.cssnano()))
		.pipe($.concat('style.min.css'))
		.pipe($.size({title: 'styles'}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./'));
});

// Concatenate And Minify JavaScript
gulp.task('scripts', function () {
	gulp.src(SOURCESJS)
	.pipe($.sourcemaps.init())
	.pipe(babel({
		"presets": ["es2015"],
		"only": [
			"assets/src/js/es6.js"
		]
	}))
	.pipe($.concat('abraham.js'))
	.pipe($.sourcemaps.write())
	.pipe(gulp.dest('assets/js'))
	.pipe($.concat('abraham.min.js'))
	.pipe($.uglify())
	.pipe($.size({title: 'scripts'}))
	.pipe($.sourcemaps.write('.'))
	.pipe(gulp.dest('assets/js'))
});

// Concatenate And Minify JavaScript
gulp.task('jq_scripts',  function () {
	gulp.src(SOURCESJQ)
	.pipe($.sourcemaps.init())
	// .pipe($.babel())
	.pipe($.concat('jq-main.js'))
	.pipe(gulp.dest('assets/js'))
	.pipe($.uglify())
	.pipe($.concat('jq-main.min.js'))
	.pipe($.sourcemaps.write('.'))
	.pipe(gulp.dest('assets/js'))
	.pipe($.size({title: 'jq_scripts'}))
});

/**
 * Defines the list of resources to watch for changes.
 */
// Build and serve the output
gulp.task('serve', ['scripts', 'styles'], function () {
	browserSync.init({
		// proxy: "local.wordpress.dev"
		// proxy: "local.wordpress-trunk.dev"
		proxy: 'rcdoc.dev'
			// proxy: "127.0.0.1:8080/wordpress/"
	});

	gulp.watch(['*/**/*.php'], reload);
	gulp.watch(['src/**/*.{scss,css}'], ['styles', reload]);
	gulp.watch(['src/**/*.js'], ['lint', 'scripts']);
	gulp.watch(['assets/src/images/**/*'], reload);
});

// Build production files, the default task
gulp.task('default', function (cb) {
	runSequence(
		'styles', ['scripts', 'jq_scripts', 'images'],
		cb);
});
