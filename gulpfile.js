/* File: gulpfile.js */

// grab our gulp packages
var gulp         = require('gulp'),
	sass         = require('gulp-sass'),
	rename       = require('gulp-rename'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemap    = require('gulp-sourcemaps'),
	uglify       = require('gulp-uglify'),
	concat       = require('gulp-concat');

gulp.task('sass', function() {
	return gulp.src('sass/style.scss')
		.pipe(sourcemap.init())
		.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(autoprefixer("last 2 versions", "> 2%", "ie 8"))
		.pipe(rename('style.min.css'))
		.pipe(sourcemap.write('./'))
		.pipe(gulp.dest('./'));
});

gulp.task('js', function() {
    return gulp.src('./js/**/*.js')
      .pipe(uglify())
      .pipe(concat('scripts.js'))
      .pipe(gulp.dest('./'));
});

gulp.task('serve', ['sass', 'js'], function(){
	gulp.watch('./**/*.scss', ['sass']);
	gulp.watch('./**/*.js', ['js']);
});

gulp.task('default', ['serve']);
