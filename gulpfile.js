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
const pcImport = require('postcss-import');
const pcMixins = require('postcss-mixins');
const pcColor = require('postcss-color-function');
const pcNested = require('postcss-nested');
const pcMedia = require('postcss-custom-media');
const pcProperties = require('postcss-custom-properties');
const pcSvar = require('postcss-simple-vars');
const pcStrip = require('postcss-strip-units');
const pcSpec = require('postcss-increase-specificity');
const pcDisComments = require('postcss-discard-comments');
const pcDisEmpty = require('postcss-discard-empty');
const context = require('postcss-plugin-context');

const $ = require('gulp-load-plugins')();
const reload = browserSync.reload;

const BANNER = [
	'/*',
	'Theme Name: Abraham',
	'Theme URI: https://github.com/DioceseOfCharlotte/abraham',
	'Author: Marty Helmick',
	'Author URI: https://github.com/m-e-h',
	'Description: Abraham is a Parent theme with many children.',
	'Version: 0.9.7',
	'License: GNU General Public License v2 or later',
	'License URI: http://www.gnu.org/licenses/gpl-2.0.html',
	'Text Domain: abraham',
	'GitHub Theme URI: https://github.com/DioceseOfCharlotte/abraham',
	'*/',
  	'\n'
].join('\n');

const AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'last 2 ff versions',
	'last 2 chrome versions',
	'last 2 edge versions',
	'last 2 safari versions',
	'last 2 opera versions',
	'ios >= 7',
	'android >= 4.4'
];

const POSTCSS_PLUGINS = [
	pcImport,
	pcProperties,
	context({ pcSpec: pcSpec({ repeat: 1 }) }),
	pcStrip,
	pcMixins,
	pcSvar,
	pcColor,
	pcMedia,
	pcNested,
	pcDisComments,
	pcDisEmpty,
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
		.pipe($.header(BANNER))
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
		.pipe($.sourcemaps.init())
		.pipe($.babel({
			"presets": ["es2015"]
		}))
		.pipe($.concat('abraham.js'))
		.pipe(gulp.dest('js'))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('js'))
		.pipe($.if('*.js', $.uglify()))
		.pipe(ignore.exclude('*.map'))
		.pipe(rev())
		.pipe(gulp.dest('js'))
		.pipe($.size({
			title: 'scripts'
		}))
		.pipe(rev.manifest({
			merge: true
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
