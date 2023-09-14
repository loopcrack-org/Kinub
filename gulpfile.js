const { src, dest, watch, parallel, task } = require("gulp");
const rename = require("gulp-rename");
const { basename, extname } = require("path");

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

// mode
function getMode() {
  const pattern = /--mode=(admin|public|common)/;
  const value = process.argv.find((e) => e.match(pattern)) ?? "";
  const mode = value.replace("--mode=", "");
  return mode;
}

const mode = getMode();

// ------------------------------------------------------------------- //
// PATHS
const paths = {
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
// ------------------------------------------------------------------- //

// ------------------------------------------------------------------- //
// CSS
async function compileSass(path, emptyDir = false, production = false) {
  if (emptyDir) await del(paths.output.css);
  if(!production) {
    return src(path)
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(sourcemaps.write("."))
      .pipe(dest(paths.output.css));
  } else {
    return src(path)
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(dest(paths.output.css));
  }
}
// ------------------------------------------------------------------- //

// JS
// ------------------------------------------------------------------- //

async function javascript(path, emptyDir = false, production = false) {
  if (emptyDir) await del(paths.output.js);
  if(!production) {
    return src(path)
    .pipe(named())
    .pipe(
      webpack({
        mode: "production",
        output: { filename: "[name].min.js" },
        devtool: "source-map",
      })
    )
    .pipe(rename({ dirname: "." }))
    .pipe(dest(paths.output.js));  
  } else {
    return src(path)
      .pipe(named())
      .pipe(webpack({mode: "production", output: {filename: "[name].min.js" }}))
      .pipe(rename({ dirname: "." }))
      .pipe(dest(paths.output.js));  
  }
}
// ------------------------------------------------------------------- //

// IMAGES
// ------------------------------------------------------------------- //
function imagenes() {
  return src(paths.input.images)
    .pipe(imagemin({ optimizationLevel: 3 }))
    .pipe(dest(paths.output.images));
}

function imageWebp() {
  return src(paths.input.images).pipe(webp()).pipe(dest(paths.output.images));
}

function imageAvif() {
  return src(paths.input.images).pipe(avif()).pipe(dest(paths.output.images));
}
// ------------------------------------------------------------------- //

// DELETE FILE
// ------------------------------------------------------------------- //
async function clean(filepath = "", typefile = "") {
  const fileName = basename(filepath, extname(filepath));
  const patternName = `${paths.output.dir}/${typefile}/${fileName}.*`;
  return await del(patternName);
}
// ------------------------------------------------------------------- //

// WATCHERS
// ------------------------------------------------------------------- //
function watchFiles() {
  // CSS
  watch(paths.input.sass).on("change", function (path, stats) {
    compileSass(path);
    console.log(`Changed ${path}`);
  });
  watch(paths.input.sass).on("add", function (path, stats) {
    compileSass(path);
    console.log(`Added ${path}`);
  });
  watch(paths.input.sass).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, "css");
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });

  // JS
  watch(paths.input.js).on("change", function (path, stats) {
    javascript(path);
    console.log(`Changed ${path}`);
  });
  watch(paths.input.js).on("add", function (path, stats) {
    javascript(path);
    console.log(`Added ${path}`);
  });
  watch(paths.input.js).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, "js");
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });
}

task("development", async function() {
  await javascript(paths.input.js, true);
  await compileSass(paths.input.sass, true);
});

task('build', async function() {
  await javascript(paths.input.js, true, true);
  await compileSass(paths.input.sass, true, true);
})

exports.default = parallel("build");
exports.dev = parallel("development", watchFiles);
exports.images = parallel(imagenes, imageWebp, imageAvif); // imagenes
