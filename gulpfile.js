/**
 *
 *  Abraham
 *
 */

'use strict';

// Include Gulp & Tools We'll Use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');
var rename = require('gulp-rename');
var composer = require('gulp-composer');
var csscomb = require('gulp-csscomb');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var reload = browserSync.reload;

var AUTOPREFIXER_BROWSERS = [
  'ie >= 9',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 6',
  'android >= 4.3',
  'bb >= 10'
];

gulp.task('composer', function () {
    composer({ cwd: './', bin: 'composer' });
});

// Optimize Images
gulp.task('images', function () {
  return gulp.src('src/images/**/*')
    .pipe($.imagemin({
      progressive: true,
      interlaced: true,
      removeUselessStrokeAndFill: true,
      removeEmptyAttrs: true
    }))
    .pipe(gulp.dest('images'))
    .pipe($.if('*.svg', $.rename({
			prefix: 'svg-',
			extname: '.php'
		})))
    .pipe(gulp.dest('partials/svg'));
});

// Copy hybrid-core to extras
gulp.task('hybrid', function () {
  return gulp.src([
  	'vendor/justintadlock/hybrid-core/**/*'
  	])
    .pipe(gulp.dest('hybrid'));
});

// Compile and Automatically Prefix Stylesheets
gulp.task('styles', function () {
  return gulp.src([
    'src/styles/*.scss',
    'src/styles/**/*.css',
    'src/styles/style.scss'
  ])
    .pipe($.changed('styles', {extension: '.scss'}))
    .pipe($.sass({
      precision: 10
    }))
    .on('error', console.error.bind(console))
    .pipe($.autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
    .pipe(csscomb())
    .pipe(gulp.dest('./'))
    //Concatenate And Minify Styles
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./'))
    .pipe($.if('*.css', $.csso()))
    .pipe(gulp.dest('./'));
});

// Concatenate And Minify JavaScript
gulp.task('scripts', function() {
  var sources = ['src/scripts/**/*.js'];
  return gulp.src(sources)
    .pipe($.concat('main.js'))
    .pipe(gulp.dest('js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe($.uglify({preserveComments: 'some'}))
    // Output Files
    .pipe(gulp.dest('js'));
});

// Build and serve the output
gulp.task('serve', ['default'], function () {
  browserSync({
    proxy: "local.wordpress.dev"
    //proxy: "doc-beta.dev"
     });

  gulp.watch(['**/*.php'], reload);
  gulp.watch(['src/styles/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch(['src/scripts/**/*.js'], reload);
  gulp.watch(['src/images/**/*'], reload);
});

// Build Production Files, the Default Task
gulp.task('default', ['hybrid'], function (cb) {
  runSequence('composer', ['styles', 'scripts', 'images', 'hybrid'], cb);
});
