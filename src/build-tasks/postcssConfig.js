const autoPrefixer = require("autoprefixer");
const postcss = require("gulp-postcss");
const pcColor = require("postcss-color-function");
const pcMedia = require("postcss-custom-media");
const pcDisComments = require("postcss-discard-comments");
const pcDisEmpty = require("postcss-discard-empty");
const pcImport = require("postcss-import");
const pcSpec = require("postcss-increase-specificity");
const pcMixins = require("postcss-mixins");
const pcNested = require("postcss-nested");
const context = require("postcss-plugin-context");
const pcSvar = require("postcss-simple-vars");
const pcStrip = require("postcss-strip-units");

module.exports = () => {
	return postcss([
		pcImport(),
		pcMixins(),
		pcSvar(),
		context({ pcSpec: pcSpec({ repeat: 1 }) }),
		pcStrip(),
		pcColor(),
		pcMedia(),
		pcNested(),
		pcDisComments(),
		pcDisEmpty(),
		autoPrefixer()
	]);
};
