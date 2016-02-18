/**
 * MEH gulp
 */

// 'use strict';

var gulp = require('gulp');
var cssfmt = require('gulp-cssfmt');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var gulpLoadPlugins = require('gulp-load-plugins');
var postcss = require('gulp-postcss');
var babel = require('gulp-babel');
var oldie = require('oldie');
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
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4.4',
    'bb >= 10'
];

var POSTCSS_PLUGINS = [
	autoPrefixer({
		browsers: AUTOPREFIXER_BROWSERS
	})
];

var POSTCSS_IE = [
	autoPrefixer({
		browsers: ['IE 8', 'IE 9']
	}),
	postcssFlex,
	oldie
];

var SOURCESJS = [
	'src/scripts/main.js'
];

// Scripts that rely on jQuery
var SOURCESJQ = [
	'src/scripts/jq-main.js'
];

// ***** Development tasks ****** //
// Lint JavaScript
gulp.task('lint', function () {
	gulp.src('src/scripts/*.js')
	.pipe(xo())
});

// ***** Production build tasks ****** //
// Optimize images
gulp.task('images', function () {
	gulp.src('src/images/**/*.{svg,png,jpg}')
	.pipe($.cache($.imagemin({
		progressive: true,
		interlaced: true
	})))
	.pipe(gulp.dest('images'))
	.pipe($.size({title: 'images'}))
});

// Compile and Automatically Prefix Stylesheets (production)
gulp.task('styles', function () {
	gulp.src('src/styles/style.scss')
		.pipe($.sourcemaps.init())
		.pipe($.sass({
			precision: 10,
			onError: console.error.bind(console, 'Sass error:')
		}))
		.pipe(gulp.dest('.tmp'))
		.pipe(postcss(POSTCSS_PLUGINS))
		.pipe($.concat('style.css'))
		.pipe(cssfmt())
		.pipe(gulp.dest('./'))
		.pipe($.size({title: 'styles'}))
		.pipe($.if('*.css', $.cssnano()))
		.pipe($.concat('style.min.css'))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./'))
});

gulp.task('oldie', function () {
	gulp.src('.tmp/style.css')
	.pipe(postcss(POSTCSS_IE))
	.pipe($.concat('oldie.css'))
	.pipe(gulp.dest('css'))
});

// Concatenate And Minify JavaScript
gulp.task('scripts', function () {
	gulp.src(SOURCESJS)
	.pipe(babel({
		"presets": ["es2015"],
		"only": [
			"src/js/es6.js"
		]
	}))
	.pipe($.concat('abraham.js'))
	.pipe(gulp.dest('js'))
	.pipe($.uglify())
	.pipe($.concat('abraham.min.js'))
	.pipe(gulp.dest('js'))
	.pipe($.size({title: 'scripts'}))
});

// Concatenate And Minify JavaScript
gulp.task('jq_scripts',  function () {
	gulp.src(SOURCESJQ)
	// .pipe($.babel())
	.pipe($.concat('jq-main.js'))
	.pipe(gulp.dest('js'))
	.pipe($.uglify())
	.pipe($.concat('jq-main.min.js'))
	.pipe(gulp.dest('js'))
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
	gulp.watch(['src/images/**/*'], reload);
});

// Build production files, the default task
gulp.task('default', function (cb) {
	runSequence(
		'styles', ['oldie', 'scripts', 'jq_scripts', 'images'],
		cb);
});
