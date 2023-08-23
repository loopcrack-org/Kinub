const { task, src, dest, watch, parallel} = require("gulp");

//Css
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");

// Imagenes
const cache = require("gulp-cache");
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

//Js
const rename = require("gulp-rename");
const uglify = require('gulp-uglify');

const paths = {
    src: "./src",
    scss: {
        admin: './src/sass/admin/config/app.scss',
        public: './src/sass/public/app.scss',
        bootstrap: './src/sass/admin/config/bootstrap.scss',
    },
    js: "./src/js/**/*.js",
    images: "./src/images/**/**",
    dest: "./public/assets",
};

function publicCss() {
    const destPath = `${paths.dest}/css`;
    return src(paths.scss.public)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(rename('public.min.css'))
        .pipe(sourcemaps.write("."))
        .pipe(dest(destPath));
}

function adminCss() {
  const destPath = `${paths.dest}/css`;
  return src(paths.scss.admin)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(rename('admin.min.css'))
    .pipe(sourcemaps.write("."))
    .pipe(dest(destPath));
}
function bootstrap() {
  const destPath = `${paths.dest}/css`;
  return src(paths.scss.bootstrap)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(rename('bootstrap.min.css'))
    .pipe(sourcemaps.write("."))
    .pipe(dest(destPath));
}

function javascript() {
  return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(uglify())
      .pipe(sourcemaps.write("."))
      .pipe(dest(`${paths.dest}/js`));
}

function imagenes() {
  return src(paths.img)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest(`${paths.dest}/img`));
}

function imageWebp() {
  return src(paths.img)
    .pipe(cache(webp()))
    .pipe(dest(`${paths.dest}/img`));
}

function imageAvif() {
  return src(paths.img)
    .pipe(cache(avif()))
    .pipe(dest(`${paths.dest}/avif`));
}

function watchFiles() {
  watch(paths.scss.public, publicCss);
  watch(paths.scss.admin, adminCss);
  watch(paths.js, javascript);
  watch(paths.images, imagenes);
  watch(paths.images, imageAvif);
  watch(paths.images, imageWebp);
}

exports.bootstrap = bootstrap;
exports.css = parallel(adminCss, publicCss);
exports.javascript = javascript;
exports.watchFiles = watchFiles;
exports.default = parallel(adminCss, publicCss, javascript, watchFiles);