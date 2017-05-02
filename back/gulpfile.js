var elixir = require('laravel-elixir');
var gulp = require('gulp');
var rev = require('gulp-rev');
var revDel = require('rev-del');
var vinylPaths = require('vinyl-paths');
var config = elixir.config;

var prefixDirToFiles = function(dir, files) {
	if ( ! Array.isArray(files)) files = [files];

	return files.map(function(file) {
		return dir + '/' + file.replace(dir, '');
	});
};

elixir.extend('revision', function(src, buildDir) {

	src = prefixDirToFiles(config.publicDir, src);
	buildDir = buildDir ? buildDir : config.publicDir + '/build';

	gulp.task('revision', function() {
		var files = vinylPaths();

		return gulp.src(src)
			.pipe(gulp.dest(buildDir))
			.pipe(files)
			.pipe(rev())
			.pipe(gulp.dest(buildDir))
			.pipe(rev.manifest())
			.pipe(revDel({ dest: buildDir }))
			.pipe(gulp.dest(buildDir));
	});

	this.registerWatcher('revision', src);

	return this.queueTask('revision');
});

elixir(function(mix) {
	mix
		.less('app.less')
		.styles([
			'vendor/bootstrap/dist/css/bootstrap.css',
			'vendor/font-awesome/css/font-awesome.min.css',
			'vendor/simple-line-icons/css/simple-line-icons.css',
			'vendor/animate.css/animate.css',
			'css/app.css'
		], 'static/control/css/all.css', 'static/control/')
		.scripts([
			'vendor/jquery/dist/jquery.min.js',
			'vendor/underscore/underscore-min.js',
			'vendor/bootstrap/dist/js/bootstrap.js',
			'vendor/yepnope/src/yepnope.js',
			'vendor/async/lib/async.js',
			'js/app/drags.js',
			// 'vendor/garlicjs/dist/garlic.min.js',
			'js/app/application.js'
		], 'static/control/js/app.js', 'static/control/')
		.revision([
			'css/all.css',
			'js/app.js'
		]);
});
