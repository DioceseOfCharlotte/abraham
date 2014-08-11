/**
 *
 *  Abraham
 *
 */

'use strict';

// Include Gulp & Tools We'll Use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
//var composer = require('gulp-composer');
//var del = require('del');
//var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var sass = require('gulp-ruby-sass');
var csso = require('gulp-csso');
var rename = require("gulp-rename");
var csscomb = require('gulp-csscomb');

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

// Optimize Images
gulp.task('images', function () {
  return gulp.src('images/**/*')
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))
    .pipe(gulp.dest('images'));
});

gulp.task('styles', function () {
    return gulp.src('styles/components/**/*.scss')
        .pipe(sass())
        .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
        .pipe(csscomb())
        .pipe(gulp.dest('./'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./'))
        .pipe(csso())
        .pipe(gulp.dest('./'))
        .pipe(reload({stream:true}));;
});

// Watch Files For Changes & Reload
gulp.task('serve', function () {
  browserSync({
    proxy: "local.wordpress-trunk.dev",
    host: "192.168.50.1"
     });

 gulp.watch(['**/*.php'], reload);
  gulp.watch(['styles/**/*.scss'], ['styles']);
  gulp.watch(['./*.css'], reload);
  gulp.watch(['scripts/**/*.js'], ['jshint']);
  gulp.watch(['images/**/*'], reload);
});

//Default task
gulp.task('default', ['styles', 'images', 'serve']);
