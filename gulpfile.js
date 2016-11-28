/**
 * MEH gulp
 */

'use strict';

const fs = require('graceful-fs');
const path = require('path');
const gulp = require('gulp');
const rev = require('gulp-rev');
const ignore = require('gulp-ignore');
const browserSync = require('browser-sync');
const runSequence = require('run-sequence');

const autoPrefixer = require('autoprefixer');
const atImport = require("postcss-import");
const pcMixins = require("postcss-mixins");
const pcColor = require('postcss-color-function');
const pcNested = require("postcss-nested");
const pcMedia = require("postcss-custom-media");
const pcProperties = require("postcss-custom-properties");
const pcSvg = require('postcss-inline-svg');
const pcSvar = require('postcss-simple-vars');
const pcStrip = require('postcss-strip-units');

const $ = require('gulp-load-plugins')();
const reload = browserSync.reload;

const AUTOPREFIXER_BROWSERS = [
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

const POSTCSS_PLUGINS = [
	atImport,
	pcProperties,
	pcStrip,
	pcMixins,
	pcSvar,
	pcColor,
	pcMedia,
	pcNested,
	pcSvg({
		path: './images/icons'
	}),
	autoPrefixer({
		browsers: AUTOPREFIXER_BROWSERS
	})
];

const SOURCESJS = [
	'src/scripts/detabinator.js',
	'src/scripts/navigation.js',
	'src/scripts/off-canvas.js',
	'src/scripts/main.js'
];

// ***** Development tasks ****** //
// Lint JavaScript
gulp.task('lint', () => {
	gulp.src('src/scripts/*.js')
		.pipe(xo())
});

// ***** Production build tasks ****** //
// Optimize images
gulp.task('images', () => {
	gulp.src('src/images/icons/*.svg')
		.pipe($.svgmin({
			plugins: [{
				cleanupIDs: true
			}, {
				removeTitle: true
			}, {
				removeAttrs: {
					attrs: '(fill|stroke)'
				}
			}, {
				addClassesToSVGElement: {
					className: 'v-icon'
				}
			}, {
				removeUselessStrokeAndFill: true
			}, {
				cleanupNumericValues: {
					floatPrecision: 2
				}
			}, {
				removeNonInheritableGroupAttrs: true
			}, {
				removeDimensions: true
			}]
		}))
		.pipe(gulp.dest('./images/icons'))
		.pipe($.size({
			title: 'images'
		}))
});

gulp.task('styles', () => {
	gulp.src('src/styles/index.css')
		.pipe($.sourcemaps.init())
		.pipe($.postcss(POSTCSS_PLUGINS))
		.pipe($.concat('style.css'))
		.pipe($.stylefmt())
		.pipe(gulp.dest('./'))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./'))
		.pipe($.if('*.css', $.cssnano()))
		.pipe(ignore.exclude('*.map'))
		.pipe(rev())
		.pipe(gulp.dest('./'))
		.pipe($.size({
			title: 'styles'
		}))
		.pipe(rev.manifest({
            merge: true
        }))
		.pipe(gulp.dest('./'))
});

// Concatenate And Minify JavaScript
gulp.task('scripts', () => {
	gulp.src(SOURCESJS)
		.pipe($.babel({
			"presets": ["es2015"]
		}))
		.pipe($.concat('abraham.js'))
		.pipe(gulp.dest('js'))
		.pipe($.uglify())
		.pipe(rev())
		.pipe(gulp.dest('js'))
		.pipe($.size({
			title: 'scripts'
		}))
		.pipe(rev.manifest({
            merge: true // merge with the existing manifest if one exists
        }))
		.pipe(gulp.dest('./'))
});

/**
 * Defines the list of resources to watch for changes.
 */
// Build and serve the output
gulp.task('serve', ['scripts', 'styles'], () => {
	$.browserSync.init({
		proxy: "local.wordpress.dev"
		// proxy: "local.wordpress-trunk.dev"
		// proxy: "127.0.0.1:8080/wordpress/"
	});

	gulp.watch(['*/**/*.php'], reload);
	gulp.watch(['src/styles/**/*.{scss,css}'], ['styles', reload]);
	gulp.watch(['src/scripts/**/*.js'], ['lint', 'scripts']);
	gulp.watch(['src/images/**/*'], reload);
});

// Build production files, the default task
gulp.task('default', cb => {
	runSequence('images', 'styles', 'scripts', cb);
});
