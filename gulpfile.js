var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('styles', function () {
  gulp.src('./theme/sass/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./theme'));
});

gulp.task('styles:watch', function () {
  gulp.watch('./theme/sass/**/*.scss', ['styles']);
});
