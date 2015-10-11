var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');

gulp.task('styles', function () {
  gulp.src('./theme/sass/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('./theme'))
    .pipe(livereload());
});

gulp.task('watch', function () {
  livereload.listen();

  gulp.watch('./theme/sass/**/*.scss', ['styles']);
});

gulp.task('default', ['watch'], function() {
});
