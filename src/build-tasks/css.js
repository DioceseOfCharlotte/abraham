const gulp = require("gulp");
const sourcemaps = require("gulp-sourcemaps");
const concat = require("gulp-concat");
const header = require("gulp-header");
const stylelint = require("gulp-stylelint");

const postcssConfig = require("./postcssConfig");
const comment = require("./headerComment");

const css = () => {
	return gulp
		.src(`${global.__buildConfig.src}/styles/index.css`)
		.pipe(sourcemaps.init())
		.pipe(postcssConfig())
		.pipe(concat("style.css"))
		.pipe(stylelint({ fix: true }))
		.pipe(header(comment.task))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(global.__buildConfig.dest));
};

module.exports = {
	task: css
};
