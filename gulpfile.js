"use strict";

// Requirements.
var gulp=require('gulp');

var autoprefixer=require('gulp-autoprefixer');
var imagemin=require('gulp-imagemin');
var cssnano=require('gulp-cssnano');
var rename=require('gulp-rename');
var sass=require('gulp-sass');
var sourcemaps=require('gulp-sourcemaps');


// Options.
var options={
	autoprefixer:[
		'last 2 versions',
		'ie >= 11'
	],
	sass:{
		errLogToConsole:true,
		outputStyle:'expanded'
	}
};

// CSS.
function scss()
{
	// noinspection JSUnresolvedFunction
	return gulp.src('assets/*/scss/*.scss', {base:'./'})
		.pipe(sourcemaps.init())
		.pipe(sass(options.sass).on('error', sass.logError))
		.pipe(autoprefixer(options.autoprefixer))
		.pipe(sourcemaps.write())
		.pipe(rename(function(path)
		{
			var temp=path.dirname.slice(0, -4);
			path.dirname=temp+'css';

		}))
		.pipe(gulp.dest('.'))
		.pipe(cssnano())
		.pipe(rename({suffix:'.min'}))
		.pipe(gulp.dest('.'));
}

// Images.
function images()
{
	return gulp.src('assets/*/images/**', {base:'./'})
		.pipe(imagemin({
			svgoPlugins:[
				{
					removeViewBox:false
				}
			]
		}))
		.pipe(gulp.dest('./'));
}

// Watcher.
function watch()
{
	gulp.watch('assets/*/scss/**/_*.scss', scss);
	gulp.watch('assets/*/scss/*.scss', scss);
}

// Tasks.
gulp.task('scss', scss);
gulp.task('images', images);

gulp.task('build', gulp.parallel(scss, images));
gulp.task('default', gulp.series('build', watch));