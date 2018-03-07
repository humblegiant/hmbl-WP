/* File: gulpfile.js */

// grab the gulp packages
var gulp         = require('gulp'),
	sass         = require('gulp-sass'),
	sourcemaps   = require('gulp-sourcemaps'),
	autoprefixer = require('gulp-autoprefixer'),
	uglify       = require('gulp-uglify'),
	concat       = require('gulp-concat'),
	plumber       = require('gulp-plumber');

// Sass public compiler
gulp.task('public-sass', function() {
	return gulp.src('_source/scss/main.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(autoprefixer('last 2 versions', '> 2%', 'ie 9'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./css/'));
});

// Sass admin compiler
gulp.task('admin-sass', function() {
	return gulp.src('_source/scss/admin.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer('last 2 versions', '> 2%', 'ie 9'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./css/'));
});

// Group the sass tasks into one
gulp.task('sass', ['public-sass', 'admin-sass']);


// Process public javascript
gulp.task('public-js', function() {
	return gulp.src('_source/js/public/**/*.js')
		.pipe(plumber())
		.pipe(uglify())
		.pipe(concat('script.min.js'))
		.pipe(gulp.dest('./js/'));
});

// Process admin javascript
gulp.task('admin-js', function() {
	return gulp.src('_source/js/admin/**/*.js')
		.pipe(plumber())
		.pipe(uglify())
		.pipe(concat('admin.min.js'))
		.pipe(gulp.dest('./js/'));
});

// Group the js tasks into one
gulp.task('js', ['public-js', 'admin-js']);


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
