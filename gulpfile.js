/* File: gulpfile.js */

// grab the gulp packages
var gulp         = require('gulp'),
	sass         = require('gulp-sass'),
	sourcemaps   = require('gulp-sourcemaps'),
	autoprefixer = require('gulp-autoprefixer'),
	minifier     = require('gulp-clean-css'),
	uglify       = require('gulp-uglify'),
	concat       = require('gulp-concat');

// Sass compiler
gulp.task('sass', function() {
	return gulp.src('_source/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(autoprefixer("last 2 versions", "> 2%", "ie 9"))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./css/'));
});

// Process javascript
gulp.task('js', function() {
    return gulp.src('_source/js/**/*.js')
      .pipe(uglify()).on('error', logError)
      .pipe(concat('script.min.js'))
      .pipe(gulp.dest('./js/'));
});

// Watch for changes
gulp.task('serve', ['sass', 'js'], function(){
	gulp.watch('_source/**/*.scss', ['sass']);
	gulp.watch('_source/**/*.js', ['js']);
});

// Set serve as default task
gulp.task('default', ['serve']);

// Error handler
var logError = function(error) {
	var formattedString;
	var prefix = '#   ';
	formattedString  = prefix + 'ERROR [' + error.plugin + '] [Line number: ' + error.lineNumber + ']\n';
	formattedString += prefix + error.message.replace(/: /,'\r\n' + prefix);

	console.log(formattedString);

	this.emit('end');
};
