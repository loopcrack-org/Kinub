const { src, dest, watch, parallel, task } = require("gulp");
const rename = require("gulp-rename");
const { basename, extname } = require("path");
const plumber = require("gulp-plumber");

//Css
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const del = require("del");

// JS
const webpack = require("webpack-stream");
const named = require("vinyl-named");

// Imagenes
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

//BrowserSync
const browserSync = require("browser-sync").create();
require("dotenv").config();

// mode
const modes = ["public", "common", "admin"];

// ------------------------------------------------------------------- //
// PATHS
function getPaths(mode = "public") {
  return {
    input: {
      sass: `./src/${mode}/sass/**/*.scss`,
      js: `./src/${mode}/js/**/*.js`,
      images: "./src/images/**/*",
    },
    output: {
      dir: `./public/assets/${mode}`,
      css: `./public/assets/${mode}/css`,
      js: `./public/assets/${mode}/js`,
      images: "./public/assets/images",
    },
  };
}
// ------------------------------------------------------------------- //

function serve() {
  browserSync.init({
    proxy: process.env.virtualHost,
    port: 8080,
    notify: true,
  });

  browserSync
    .watch([
      "public/**/*.*",
      "!public/**/css/*.css", //Ignore CSS changes since we are using browserSync.stream() for CSS
    ])
    .on("change", browserSync.reload);

  browserSync.watch(["app/Views/**/*.*"]).on("change", browserSync.reload);
}

// ------------------------------------------------------------------- //
// CSS
async function compileSass(srcPath, destPath, production = false) {
  if (production) {
    await del(destPath);
    return src(srcPath)
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(dest(destPath));
  } else {
    return src(srcPath)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(sourcemaps.write("."))
      .pipe(dest(destPath))
      .pipe(browserSync.stream());
  }
}
// ------------------------------------------------------------------- //

// JS
// ------------------------------------------------------------------- //

async function javascript(srcPath, destPath, production = false) {
  const webpackConfig = {
    mode: production ? "production" : "development",
    output: { filename: "[name].min.js" },
  };
  if (production) {
    await del(destPath);
    return src(srcPath)
      .pipe(named())
      .pipe(webpack(webpackConfig))
      .pipe(rename({ dirname: "." }))
      .pipe(dest(destPath));
  } else {
    webpackConfig["devtool"] = "source-map";
    return src(srcPath)
      .pipe(plumber())
      .pipe(named())
      .pipe(webpack(webpackConfig))
      .pipe(rename({ dirname: "." }))
      .pipe(dest(destPath));
  }
}
// ------------------------------------------------------------------- //

// IMAGES
// ------------------------------------------------------------------- //
async function minifyImage(sourcePath, dist) {
  return src(sourcePath)
    .pipe(imagemin({ optimizationLevel: 3 }))
    .pipe(dest(dist));
}

async function convertToWebp(sourcePath, dist) {
  return src(sourcePath).pipe(webp()).pipe(dest(dist));
}

async function convertToAvif(sourcePath, dist) {
  return src(sourcePath).pipe(avif()).pipe(dest(dist));
}
// ------------------------------------------------------------------- //

// DELETE FILE
// ------------------------------------------------------------------- //
async function clean(filepath = "", dist) {
  const fileName = basename(filepath, extname(filepath));
  const patternName = `${dist}/${fileName}.*`;
  return await del(patternName);
}
// ------------------------------------------------------------------- //

// WATCHERS
// ------------------------------------------------------------------- //
function watchFiles(input, output) {
  // CSS
  watch(input.sass).on("change", function (path, stats) {
    compileSass(input.sass, output.css);
    console.log(`Changed ${path}`);
  });
  watch(input.sass).on("add", function (path, stats) {
    compileSass(path, output.css);
    console.log(`Added ${path}`);
  });
  watch(input.sass).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, output.css);
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });

  // JS
  watch(input.js).on("change", function (path, stats) {
    javascript(path, output.js);
    console.log(`Changed ${path}`);
  });
  watch(input.js).on("add", function (path, stats) {
    javascript(path, output.js);
    console.log(`Added ${path}`);
  });
  watch(input.js).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, output.js);
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });
}

function runMode(mode, production = false) {
  const { input, output } = getPaths(mode);

  return async function devTasks() {
    await compileSass(input.sass, output.css, production);
    await javascript(input.js, output.js, production);
    if (!production) watchFiles(input, output);
  };
}

function compileImages() {
  const { input, output } = getPaths();
  return async function images() {
    await minifyImage(input.images, output.images);
    await convertToWebp(input.images, output.images);
    await convertToAvif(input.images, output.images);
  };
}

task("dev:public", runMode(serve, "public"));
task("dev:common", runMode(serve, "common"));
task("dev:admin", runMode(serve, "admin"));
task(
  "dev:all",
  parallel(
    serve,
    modes.map((mode) => runMode(mode))
  )
);
task("build", parallel(modes.map((mode) => runMode(mode, true))));
task("images", compileImages());
