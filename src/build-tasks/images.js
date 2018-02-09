const gulp = require("gulp");
const imagemin = require("gulp-imagemin");

const extensions = ["jpeg", "jpg", "png", "gif", "svg"];

const images = () => {
	return gulp
		.src(`${global.__buildConfig.src}/images/**/*.{${extensions.join(",")}}`)
		.pipe(
			imagemin([
				imagemin.gifsicle({ interlaced: true }),
				imagemin.jpegtran({ progressive: true }),
				imagemin.optipng({ optimizationLevel: 5 }),
				imagemin.svgo({
					plugins: [
						{ cleanupIDs: true },
						{ removeTitle: true },
						{ removeViewBox: false },
						{ removeAttrs: { attrs: "(fill|stroke)" } },
						{ addClassesToSVGElement: { className: "v-icon" } },
						{ removeUselessStrokeAndFill: true },
						{ cleanupNumericValues: { floatPrecision: 2 } },
						{ removeNonInheritableGroupAttrs: true },
						{ removeDimensions: true }
					]
				})
			])
		)
		.pipe(gulp.dest(`${global.__buildConfig.dest}/images`));
};

module.exports = {
	task: images
};
