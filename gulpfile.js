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
  return gulp.src('images/**/*')
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))
    .pipe(gulp.dest('images'));
});

// Copy hybrid-core to extras
gulp.task('hybrid', function () {
  return gulp.src([
  	'vendor/justintadlock/**/*'
  	])
    .pipe(gulp.dest('./'));
});

// Copy CMB2 to extras
gulp.task('cmb2', function () {
  return gulp.src([
  	'vendor/webdevstudios/**/*'
  	])
    .pipe(gulp.dest('abe-extras/extensions'));
});

// Compile and Automatically Prefix Stylesheets
gulp.task('styles', function () {
  return gulp.src([
    'scss/*.scss',
    'scss/**/*.css',
    'scss/style.scss'
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


// Build and serve the output
gulp.task('serve', function () {
  browserSync({
    proxy: "local.wordpress.dev"
     });

  gulp.watch(['**/*.php'], reload);
  gulp.watch(['scss/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch(['js/**/*.js'], reload);
  gulp.watch(['images/**/*'], reload);
});

// Build Production Files, the Default Task
gulp.task('default', ['composer'], function (cb) {
  runSequence('styles', ['images', 'cmb2', 'hybrid'], cb);
});
