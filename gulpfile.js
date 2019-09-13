var gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	fs 			= require('node-fs'),
	fse			= require('fs-extra'),
	json		= require('json-file'),
	jshint 		= require('gulp-jshint'),
	concat 		= require('gulp-concat'),
	imagemin 	= require('gulp-imagemin'),	
	plumber 	= require('gulp-plumber'),
	util 		= require('gulp-util'),
	livereload 	= require('gulp-livereload'),
	sourcemaps 	= require('gulp-sourcemaps'),
	notify 		= require('gulp-notify'),
	gulpif 		= require('gulp-if'),
	babel 		= require('gulp-babel'),
	minify 		= require('gulp-babel-minify'),
	minifyCSS 	= require('gulp-minify-css'),
	pump	 	= require('pump'),
	browserSync = require('browser-sync'),
	themeName	= json.read('./package.json').get('themeName'),
	stylish 	= require('jshint-stylish'),
	rename 		= require('gulp-rename'),
	themeDir	= '../' + themeName;

var config = {
    production: !!util.env.production
};

var plumberErrorHandler = { errorHandler: notify.onError({
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	})
};

gulp.task('browserSync', function() {
  browserSync({
    // server: {
    //   baseDir: 'app'
    // }
    proxy: "localhost:8888/edfinder-live"
  })
})

gulp.task('init', function() {
	fs.mkdirSync(themeDir, 765, true);
	fse.copySync('theme_boilerplate', themeDir + '/');
});

gulp.task('sass', function() {
	gulp.src('./css/src/**/*.scss')
		.pipe(plumber(plumberErrorHandler))
		.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./css/nova'))
	    .pipe(browserSync.reload({ // Reloading with Browser Sync
	      stream: true
	    }));
});

gulp.task('js', function() {
	gulp.src('js/src/*.js')
		.pipe(plumber(plumberErrorHandler))
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(babel({ presets: ['env'] })) 
		.pipe(config.production ? minify({ mangle: { keepClassName: true } }) : util.noop())
		.pipe(jshint.reporter( stylish ))
		.pipe(concat('theme.js'))
		.pipe(gulp.dest('js'));
});

gulp.task('watch', function() {
	gulp.watch('css/src/**/*.scss', ['sass']);
	gulp.watch('js/src/*.js', ['js']);
	gulp.watch('*.html', browserSync.reload);
	gulp.watch('*.php', browserSync.reload);
	gulp.watch('js/**/*.js', browserSync.reload);
});

gulp.task('default', ['sass', 'browserSync', 'js', 'watch']);