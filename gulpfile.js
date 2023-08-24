const { src, dest, watch, parallel} = require("gulp");

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
    admin: {
      scss: {
        app: './src/sass/admin/config/app.scss',
        bootstrap: './src/sass/admin/config/bootstrap.scss',
      },
      js: './src/js/admin/**/*.js',
      watch: {
        scss: './src/sass/admin/**/*.scss',
        js: './src/js/admin/**/*.js',
      }
    },
    public: {
      scss: './src/sass/public/app.scss',
      js: './src/js/public/**/*.js',
      watch: {
        scss: './src/sass/public/**/*.scss',
        js: './src/js/public/**/*.js',
      }
    },
    images: "./src/images/**/*",
    dest: "./public/assets", 
};

function publicCss() {
    const destPath = `${paths.dest}/css`;
    return src(paths.public.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(rename('public.min.css'))
        .pipe(sourcemaps.write("."))
        .pipe(dest(destPath));
}

function adminCss() {
  const destPath = `${paths.dest}/css`;
  return src(paths.admin.scss.app)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(rename('admin.min.css'))
    .pipe(sourcemaps.write("."))
    .pipe(dest(destPath));
}
function bootstrap() {
  const destPath = `${paths.dest}/css`;
  return src(paths.admin.scss.bootstrap)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(rename('bootstrap.min.css'))
    .pipe(sourcemaps.write("."))
    .pipe(dest(destPath));
}

function adminJavascript() {
  return src(paths.admin.js)
      .pipe(sourcemaps.init())
      .pipe(uglify())
      .pipe(sourcemaps.write("."))
      .pipe(dest(`${paths.dest}/js`));
}
function publicJavascript() {
  return src(paths.public.js)
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

function watchAdmin() {
  watch(paths.admin.watch.scss, adminCss);
  watch(paths.admin.watch.js, adminJavascript);
  watch(paths.images, imagenes);
  watch(paths.images, imageAvif);
  watch(paths.images, imageWebp);
}

function watchPublic() {
  watch(paths.public.watch.scss, publicCss);
  watch(paths.public.watch.js, publicJavascript);
  watch(paths.images, imagenes);
  watch(paths.images, imageAvif);
  watch(paths.images, imageWebp);
}

exports.bootstrap = bootstrap; // bootstrap
exports.admin = parallel(adminCss, adminJavascript, watchAdmin); // admin
exports.default = parallel(publicCss, publicJavascript, watchPublic);  // public
exports.images = parallel(imagenes, imageWebp, imageAvif); // imagenes