/**
 *
 *  Abraham
 *
 */

'use strict';

// Include Gulp & Tools We'll Use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var rename = require('gulp-rename');
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

// Optimize Images
gulp.task('images', function () {
  return gulp.src('images/**/*')
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))
    .pipe(gulp.dest('images'));
});

// Compile and Automatically Prefix Stylesheets
gulp.task('styles', function () {
  return gulp.src([
    'css/*.scss',
    'css/**/*.css',
    'css/style.scss'
  ])
    .pipe($.changed('styles', {extension: '.scss'}))
    .pipe($.rubySass({
      style: 'expanded',
      precision: 10
    }))
    .on('error', console.error.bind(console))
    .pipe($.autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
    .pipe(csscomb())
    .pipe(gulp.dest('./'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./'))
    // Concatenate And Minify Styles
    .pipe($.if('*.css', $.csso()))
    .pipe(gulp.dest('./'));
});

// Build and serve the output
gulp.task('serve', ['default'], function () {
  browserSync({
    proxy: "local.wordpress.dev",
    host: "192.168.50.1"
     });

  gulp.watch(['**/*.php'], reload);
  gulp.watch(['css/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch(['js/**/*.js'], reload);
  gulp.watch(['images/**/*'], reload);
});

// Build Production Files, the Default Task
gulp.task('default', function (cb) {
  runSequence('styles', ['images'], cb);
});
