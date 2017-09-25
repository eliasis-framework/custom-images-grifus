/**
 * Custom Images Grifus · Extensions For Grifus
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    GPL-2.0+
 * @link       https://github.com/Josantonius/Custom-Images-Grifus.git
 * @since      1.0.4
 */

// Dependencies

var gulp         = require('gulp'),
  	concat       = require('gulp-concat'),
  	uglify       = require('gulp-uglify'),
  	sass         = require('gulp-sass'),
  	plumber      = require('gulp-plumber'),
  	rename       = require('gulp-rename'),
  	cleanCSS     = require('gulp-clean-css'),
  	notify       = require('gulp-notify'),
  	sourcemaps   = require('gulp-sourcemaps'),
  	autoprefixer = require('gulp-autoprefixer');

// Tasks

gulp.task('js', function () {

	var files = 'public/js/source/*.js',
		min   = 'custom-images-grifus-admin.min.js',
		dest  = 'public/js/',

		notifyOptions = { 

			message: 'Scripts task complete' 
		};

	gulp.src(files)
		.pipe(concat(min))
		.pipe(uglify())
		.pipe(gulp.dest(dest))
		.pipe(notify(notifyOptions));
});

gulp.task('css', function () {

	var main   = 'public/sass/admin/custom-images-grifus-admin.sass',
		files  = 'public/sass/admin/**/*.sass',
		source = 'public/css/source/',
		dest   = 'public/css/',

		sourcemapsOption = { 

		  	content: { 

		  		includeContent: false 
		  	}, 

		  	init: {

		  		loadMaps: true 
		  	} 
		},

		sassOptions = {

			errLogToConsole: true, 
			outputStyle:     'expanded' 
		},

		autoprefixerOptions = { 

			browsers: ['last 2 versions'], 
			cascade:  true 
		},

		notifyOptions = {

			message: 'Styles task complete'
		},

		cssOptions = {

			compatibility: 'ie8' 
		};

		renameOptions = {

			suffix: '.min'
		};

	gulp.src(main)
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass(sassOptions).on('error', sass.logError))
		.pipe(sourcemaps.write(sourcemapsOption.content))
		.pipe(sourcemaps.init(sourcemapsOption.init))
		.pipe(autoprefixer(autoprefixerOptions))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(source))
		.pipe(rename(renameOptions))
		.pipe(cleanCSS(cssOptions))
		.pipe(gulp.dest(dest))
		.pipe(notify(notifyOptions));

});

gulp.task('watch', function () {

	var sassFiles = [
			'public/sass/admin/**/*.sass',
			'public/sass/admin/custom-images-grifus-admin.sass'
		],

		jsFiles  = 'public/js/source/*.js';

	gulp.watch(jsFiles, ['js']);

	gulp.watch(sassFiles, ['css']);

});

gulp.task('default', ['js', 'css']);
