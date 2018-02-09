/**
 * MEH gulp
 */

"use strict";

const fs = require("fs-extra");
const path = require("path");
const gulp = require("gulp");
const browserSync = require("browser-sync");

const reload = browserSync.reload;

global.__buildConfig = {
	src: path.join(__dirname, "src"),
	dest: path.join(__dirname, "./")
};

const getImages = require("./src/build-tasks/images");
const getCss = require("./src/build-tasks/css");
const getJs = require("./src/build-tasks/javascript");
const distBuild = require("./src/build-tasks/dist");

gulp.task("images", done => {
	return getImages.task(done);
});

gulp.task("styles", done => {
	return getCss.task(done);
});

gulp.task("scripts", done => {
	return getJs.task(done);
});

gulp.task("cssBuild", done => {
	return distBuild.styles(done);
});

gulp.task("jsBuild", done => {
	return distBuild.scripts(done);
});

gulp.task("dist", done => {
	return gulp.series(["cssBuild", "jsBuild"])(done);
});

// Build production files, the default task
gulp.task("default", done => {
	return gulp.series(["images", "styles", "scripts", "dist"])(done);
});
