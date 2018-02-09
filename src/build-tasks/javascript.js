const gulp = require("gulp");
const sourcemaps = require("gulp-sourcemaps");
const babel = require("gulp-babel");
const concat = require("gulp-concat");

const SOURCESJS = [
	`${global.__buildConfig.src}/scripts/helpers/element-closest.js`,
	`${global.__buildConfig.src}/scripts/helpers/js-focus-ring.js`,
	`${global.__buildConfig.src}/scripts/helpers/onClickOrTap.js`,
	`${global.__buildConfig.src}/scripts/detabinator.js`,
	`${global.__buildConfig.src}/scripts/navigation.js`,
	`${global.__buildConfig.src}/scripts/off-canvas.js`,
	`${global.__buildConfig.src}/scripts/main.js`
];

const javascript = () => {
	return gulp
		.src(SOURCESJS)
		.pipe(sourcemaps.init())
		.pipe(babel({ presets: ["env"] }))
		.pipe(concat("main.js"))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(`${global.__buildConfig.dest}/js`));
};

module.exports = {
	task: javascript
};
