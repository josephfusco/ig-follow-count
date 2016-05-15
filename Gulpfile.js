'use strict';

var gulp = require('gulp'),
	sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
	watch = require('gulp-watch');

gulp.task('styles', function () {
	gulp.src('styles/**/*.scss')
		.pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('styles/themes'));
});

gulp.task('watch', function() {
	gulp.watch('styles/**/*.scss', ['styles']);
});

gulp.task('default', ['styles', 'watch']);
