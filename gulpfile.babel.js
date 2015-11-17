/**
 * MEH gulp
 */

//'use strict';

import fs from 'fs';
import path from 'path';
import gulp from 'gulp';
import runSequence from 'run-sequence';
import browserSync from 'browser-sync';
import gulpLoadPlugins from 'gulp-load-plugins';
import pkg from './package.json';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;



const AUTOPREFIXER_BROWSERS = [
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

const SOURCESJS = [
  // ** Deps ** //
  'assets/src/scripts/mdlComponentHandler.js',
  // ** Mine ** //
  'assets/src/scripts/main.js',
];

// Scripts that rely on jQuery
const SOURCESJQ = [
  'assets/src/scripts/jq-main.js',
];

// ***** Development tasks ****** //
// Lint JavaScript
gulp.task('lint', () =>
  gulp.src('assets/src/scripts/*.js')
  .pipe($.eslint())
  .pipe($.eslint.format())
  .pipe($.if(!browserSync.active, $.eslint.failOnError()))
);

// ***** Production build tasks ****** //
// Optimize images
gulp.task('images', () =>
  gulp.src('assets/src/images/**/*.{svg,png,jpg}')
  .pipe($.cache($.imagemin({
    progressive: true,
    interlaced: true
  })))
  .pipe(gulp.dest('assets/images'))
  .pipe($.size({
    title: 'images'
  }))
);

// Compile and Automatically Prefix Stylesheets (production)
gulp.task('styles', () => {
  // For best performance, don't add Sass partials to `gulp.src`
  gulp.src('assets/src/styles/style.scss')
    // Generate Source Maps
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      precision: 10,
      onError: console.error.bind(console, 'Sass error:')
    }))
    //.pipe($.cssInlineImages({webRoot: 'src'}))
    .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
    .pipe(gulp.dest('.tmp'))
    // Concatenate Styles
    .pipe($.concat('style.css'))
    .pipe($.csscomb())
    .pipe(gulp.dest('./'))
    // Minify Styles
    .pipe($.if('*.css', $.minifyCss()))
    .pipe($.concat('style.min.css'))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('./'))
    .pipe($.size({
      title: 'styles'
    }));
});

// Concatenate And Minify JavaScript
gulp.task('scripts', () =>
  gulp.src(SOURCESJS)
  .pipe($.sourcemaps.init())
  .pipe($.babel())
  .pipe($.sourcemaps.write())
  // Concatenate Scripts
  .pipe($.concat('abraham.js'))
  .pipe(gulp.dest('assets/js'))
  // Minify Scripts
  .pipe($.uglify({
    sourceRoot: '.',
    sourceMapIncludeSources: true
  }))
  .pipe($.concat('abraham.min.js'))
  // Write Source Maps
  .pipe($.sourcemaps.write('.'))
  .pipe(gulp.dest('assets/js'))
  .pipe($.size({
    title: 'scripts'
  }))
);

// Concatenate And Minify JavaScript
gulp.task('jq_scripts', () =>
  gulp.src(SOURCESJQ)
  .pipe($.sourcemaps.init())
  //.pipe($.babel())
  .pipe($.sourcemaps.write())
  // Concatenate Scripts
  .pipe($.concat('jq-main.js'))
  .pipe(gulp.dest('assets/js'))
  // Minify Scripts
  .pipe($.uglify({
    sourceRoot: '.',
    sourceMapIncludeSources: true
  }))
  .pipe($.concat('jq-main.min.js'))
  // Write Source Maps
  .pipe($.sourcemaps.write('.'))
  .pipe(gulp.dest('assets/js'))
  .pipe($.size({
    title: 'jq_scripts'
  }))
);

/**
 * Defines the list of resources to watch for changes.
 */
// Build and serve the output
gulp.task('serve', ['scripts', 'styles'], () => {
  browserSync.init({
    //proxy: "local.wordpress.dev"
    //proxy: "local.wordpress-trunk.dev"
    proxy: "doc.dev"
      //proxy: "127.0.0.1:8080/wordpress/"
  });

  gulp.watch(['*/**/*.php'], reload);
  gulp.watch(['src/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch(['src/**/*.js'], ['lint', 'scripts']);
  gulp.watch(['assets/src/images/**/*'], reload);
});

// Build production files, the default task
gulp.task('default', cb => {
  runSequence(
    'styles', [/*'lint',*/ 'scripts', 'jq_scripts', 'images'],
    cb);
});
