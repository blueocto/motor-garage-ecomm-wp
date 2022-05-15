const { src, dest, watch, series, parallel } = require("gulp");
const sass = require("gulp-dart-sass");
const autoprefixer = require("gulp-autoprefixer");
const csso = require("gulp-csso");
const babel = require("gulp-babel");
const rename = require("gulp-rename");
const terser = require("gulp-terser");
const webpack = require("webpack-stream");
const sourcemaps = require("gulp-sourcemaps");
const del = require("del");
const mode = require("gulp-mode")();
const browserSync = require("browser-sync").create();

/* Delete the appropriate folders */
const clean = () => {
	return del(["dist"]);
};

const cleanImages = () => {
	return del(["dist/images"]);
};

const cleanFonts = () => {
	return del(["dist/fonts"]);
};

const cleanSVG = () => {
	return del(["dist/svg"]);
};

const cleanVendor = () => {
	return del(["dist/vendor"]);
};

/* Compile the Sass
 * points to files in the root of /src/ folder
 * creates sourcemaps whilst in development
 */
const css = () => {
	return (
		src("src/scss/**.scss")
			.pipe(mode.development(sourcemaps.init()))
			.pipe(sass().on("error", sass.logError))
			.pipe(autoprefixer())
			// .pipe(rename())
			.pipe(mode.production(csso()))
			.pipe(mode.development(sourcemaps.write()))
			.pipe(dest("dist/css"))
			.pipe(mode.development(browserSync.stream()))
	);
};

/* Compile JS with webpack */
const js = () => {
	return src("src/js/**.js")
		.pipe(
			babel({
				presets: ["@babel/env"],
			})
		)
		.pipe(
			webpack({
				mode: "development",
				devtool: "inline-source-map",
			})
		)
		.pipe(mode.development(sourcemaps.init({ loadMaps: true })))
		.pipe(rename("app.js"))
		.pipe(mode.production(terser({ output: { comments: false } })))
		.pipe(mode.development(sourcemaps.write()))
		.pipe(dest("dist/js"))
		.pipe(mode.development(browserSync.stream()));
};

/* Copy all images from /src/ to /dist/ */
const copyImages = () => {
	return src("src/images/**/*.{png,jpg,jpeg,gif,webp}").pipe(
		dest("dist/img")
	);
};

/* Copy all SVG from /src/ to /dist/ */
const copySVG = () => {
	return src("src/svg/**/*.svg").pipe(dest("dist/svg"));
};

/* Copy any fonts from /src/ to /dist/ */
const copyFonts = () => {
	return src("src/fonts/**/*.{eot,ttf,woff,woff2}").pipe(dest("dist/fonts"));
};

/* Copy all script files from /vendor/ to /dist/ */
const copyVendor = () => {
	return src("src/vendor/**/*.js").pipe(dest("dist/vendor"));
};

/* Watch files  for changes with BrowserSync */
const watchForChanges = () => {
	browserSync.init({
		proxy: {
			target: "https://blueocto.test/",
		},
	});
	watch("src/scss/**/*.scss", css);
	watch("src/js/**.js", js);
	watch("**/*.php").on("change", browserSync.reload);
	watch(
		"src/images/**/*.{png,jpg,jpeg,gif,webp}",
		series(cleanImages, copyImages)
	);
	watch("src/fonts/**/*.{eot,ttf,woff,woff2}", series(cleanFonts, copyFonts));
	watch("src/svg/**/*.svg", series(cleanSVG, copySVG));
	watch("src/vendor/**/*.js", series(cleanVendor, copyVendor));
};

/* Run tasks
 * series to combine tasks
 * parallel to execute simultaneously
 */
exports.default = series(
	clean,
	parallel(css, js, copyImages, copySVG, copyFonts, copyVendor),
	watchForChanges
);
exports.build = series(
	clean,
	parallel(css, js, copyImages, copySVG, copyFonts, copyVendor)
);
