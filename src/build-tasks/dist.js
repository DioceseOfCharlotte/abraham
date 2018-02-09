const gulp = require("gulp");
const cssnano = require("gulp-cssnano");
const uglify = require("gulp-uglify");
const doIf = require("gulp-if");
const size = require("gulp-size");
const rev = require("gulp-rev");

const cssMin = () => {
	return gulp
		.src(`${global.__buildConfig.dest}/style.css`)
		.pipe(cssnano())
		.pipe(rev())
		.pipe(gulp.dest(global.__buildConfig.dest))
		.pipe(size({ title: "cssSize" }))
		.pipe(rev.manifest({ merge: true }))
		.pipe(gulp.dest(global.__buildConfig.dest));
};

const jsMin = () => {
	return gulp
		.src(`${global.__buildConfig.dest}/js/main.js`)
		.pipe(uglify())
		.pipe(rev())
		.pipe(gulp.dest(`${global.__buildConfig.dest}/js`))
		.pipe(size({ title: "jsSize" }))
		.pipe(rev.manifest({ merge: true }))
		.pipe(gulp.dest(global.__buildConfig.dest));
};

module.exports = {
	styles: cssMin,
	scripts: jsMin
};
