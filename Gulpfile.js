var gulp = require('gulp'),
	sass = require('gulp-sass'),
	watch = require('gulp-watch');

gulp.task('styles', function () {
	gulp.src('css/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('css/themes'));
});

gulp.task('watch', function() {
	gulp.watch('css/**/*.scss', ['styles']);
});

gulp.task('default', ['styles', 'watch']);
