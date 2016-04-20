/* File: gulpfile.js */

// grab the gulp packages
var gulp         = require('gulp'),
	sass         = require('gulp-sass'),
	sourcemaps   = require('gulp-sourcemaps'),
	autoprefixer = require('gulp-autoprefixer'),
	minifier     = require('gulp-clean-css'),
	imagemin     = require('gulp-imagemin'),
	pngquant     = require('imagemin-pngquant'),
	uglify       = require('gulp-uglify'),
	concat       = require('gulp-concat');

// Sass compiler
gulp.task('sass', function() {
	return gulp.src('_source/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(autoprefixer("last 2 versions", "> 2%", "ie 9"))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./'));
});

// Image processing
gulp.task('processImages', function() {
	return gulp.src(['**/*.@(png|jpg|jpeg|gif|svg)', '!@(node_modules/*|bower_components/*)'])
		.pipe(imagemin({
			optimizationLevel: 2,
			progressive: true,
			use: [pngquant()]
		}))
		.pipe(gulp.dest('./'));
});

// Process javascript
gulp.task('js', function() {
    return gulp.src('_source/js/**/*.js')
      .pipe(uglify()).on('error', logError)
      .pipe(concat('script.min.js'))
      .pipe(gulp.dest('./'));
});

// Watch for changes
gulp.task('serve', ['sass', 'js'], function(){
	gulp.watch('_source/**/*.scss', ['sass']);
	gulp.watch('_source/**/*.js', ['js']);
});

// Build task
gulp.task('build', ['sass', 'js', 'processImages']);

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
