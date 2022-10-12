const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

const cleanCSS = require('gulp-clean-css');
const del = require("del");

//compile scss to css
function style() {
    //1. where is my scss files
    return gulp.src('./assets/scss/**/*.scss')
    //2. pass files throught compiler
        .pipe(sass())
    //3. where do i save my css
        .pipe(gulp.dest('./assets/css'))
    //4. stream changes to all browsers
        .pipe(browserSync.stream());
}

function watch() {
    browserSync.init({
        watch: true,       // <-- Adding this line solved my reload problem
        server: {
            baseDir: './pages/'
        },
    });
    gulp.watch('./assets/scss/**/*.scss', style);
    gulp.watch('./pages/**/*.html').on('change', browserSync.reload);
    gulp.watch('./assets/js/**/*.js').on('change', browserSync.reload);
}

function minifycss() {
    return gulp.src('./assets/css/**/*.css')
            .pipe(minifyCSS())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
            .pipe(concat('main-style.min.css'))
            .pipe(gulp.dest('./assets/css'))
}

function deletecss() {
    return del('./assets/css/main-style.min.css');
}

function minifyjs() {
    return gulp.src('./assets/js/**/*.js')
                .pipe(concat('app.min.js'))
                .pipe(uglify())
                .pipe(gulp.dest('./assets/js'))
}

function deletejs() {
    return del('./assets/js/app.min.js');
}

exports.style = style;
exports.watch = watch;
exports.minifycss = minifycss;
exports.deletecss = deletecss;
exports.minifyjs = minifyjs;
exports.deletejs = deletejs;