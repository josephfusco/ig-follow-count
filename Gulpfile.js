var gulp = require('gulp'),
	sass = require('gulp-sass'),
	watch = require('gulp-watch');

gulp.task('styles', function () {
	gulp.src('css/**/*.scss')
		.pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('styles/themes'));
});

gulp.task('watch', function() {
	gulp.watch('styles/**/*.scss', ['styles']);
});

gulp.task('default', ['styles', 'watch']);
