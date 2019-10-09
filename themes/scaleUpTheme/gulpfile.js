var gulp = require('gulp');
	sass = require('gulp-sass');
	cleanCSS = require('gulp-clean-css');
	concat = require('gulp-concat');
	minifyJS = require('gulp-minify');
	notify = require('gulp-notify');
	connect = require('gulp-connect');

gulp.task('connect', function() {
	connect.server({
		root: __dirname,
		//port: 8016,
		livereload: true
	});
}); 

//SASS
gulp.task('compile-sass', function(){
	return gulp.src('src/scss/styles.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('assets/css'))
});

gulp.task('minify-css', ['compile-sass'], function() {
	return gulp.src([
		'assets/css/*.css',
	])
    .pipe(cleanCSS())
  	.pipe(concat('styles.min.css'))
    .pipe(gulp.dest('assets/css/min'))
	.pipe(notify('CSS compilation complete: <%= file.relative %>'))
	.pipe(connect.reload());
});

gulp.task('styles', ['compile-sass', 'minify-css']);

gulp.task('watch',function() {
	gulp.watch('src/scss/**/*.scss', ['styles'])
	gulp.watch('src/js/**/*.js', ['scripts'])
	gulp.watch('*.php', ['php'])
	gulp.watch('parts/*.php', ['php'])
});


//JS
gulp.task('compile-js', function() {
	return gulp.src([
		'src/js/custom/custom.js'
  	])
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('assets/js'));
});

gulp.task('minify-js', ['compile-js'], function() {
	return gulp.src([
		'assets/js/*.js',
	])
    .pipe(minifyJS({
        ext:{
            min:'.min.js'
        },
		noSource:[],
        exclude: ['tasks'],
        ignoreFiles: ['.combo.js', '-min.js']
    }))
    .pipe(gulp.dest('assets/js/min'))
	.pipe(notify({message: 'JS compilation complete: <%= file.relative %>', onLast: true}))
	.pipe(connect.reload());
});
gulp.task('scripts', ['compile-js', 'minify-js']);

//PHP

gulp.task('php', function () {
	gulp.src('*.php')
	gulp.src('parts/*.php')
    .pipe(connect.reload());
}); 


//gulp.task('default', ['styles','watch']); 
//gulp.task('default', ['connect', 'styles','watch']); 
gulp.task('default', ['connect', 'styles', 'scripts', 'php', 'watch']);