'use strict';

// Plugins
// ----------------------------------------------------------------------------

import gulp from 'gulp';
import babel from 'gulp-babel';
import compass from 'gulp-compass';
import minify from 'gulp-minify';
import plumber from 'gulp-plumber';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import notify from 'gulp-notify';
import path from 'path';
import autoprefixer from 'gulp-autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import webpack from 'webpack-stream';

// Browser Sync
// ----------------------------------------------------------------------------

const browserSync = require('browser-sync').create();
const reload = browserSync.reload;

// Notifiers
// ----------------------------------------------------------------------------

const notifyInfo = {
  title: 'Gulp',
  icon: path.join(__dirname, 'gulp.png')
};

const plumberErrorHandler = {
  errorHandler: notify.onError({
    title: notifyInfo.title,
    icon: notifyInfo.icon,
    message: "Error: <%= error.message %>"
  })
};

// Theme
// ----------------------------------------------------------------------------

const theme = 'RENAME_ME';

// Directories
// ----------------------------------------------------------------------------

const dir = {
  app: 'theme/',
  public: `wordpress/wp-content/themes/${theme}`
}

// Files To Watch
// ----------------------------------------------------------------------------

const files = {
  input: [`${dir.public}/**/*.*`, `!${dir.publc}/assets/css/**/*.css}`],
  app: [`${dir.app}/content/**/*.*`],
  public: dir.public
}

const js = {
  input: [`${dir.app}/assets/scripts/**/*.js`,],
  main: `${dir.app}/assets/scripts/app.js`,
  output: `${dir.public}/assets/scripts`
}

const style = {
  input: `${dir.app}/assets/sass/**/*.scss`,
  sass_path: `${dir.app}/assets/sass`,
  css_path: `${dir.public}/assets/css`,
}

gulp.task('files', () => {
  gulp.src(files.app)
    .pipe(gulp.dest(files.public))
});

gulp.task('sass', () => {
  gulp.src(style.input)
    .pipe(plumber(plumberErrorHandler))
    .pipe(compass({
      css: style.css_path,
      sass: style.sass_path
    }))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false,
      grid: true
    }))
    .pipe(cleanCSS())
    .pipe(gulp.dest(style.css_path))
    .pipe(browserSync.stream());
});

gulp.task('babel', () => {
  gulp.src(js.main)
    .pipe(webpack())
    .pipe(plumber(plumberErrorHandler))
    .pipe(babel({
      presets: [
        ['es2015', { targets: { browsers: ['last 2 versions', 'safari >= 7'] } }]
      ]
    }))
    .pipe(sourcemaps.init())
    .pipe(minify({
      noSource: true,
      exclude: ['tasks'],
      ignoreFiles: ['.combo.js', '-min.js'],
    }))
    .pipe(rename({ basename: 'app' }))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest(js.output))
});

// reloading browsers

gulp.task('sass-watch', ['sass'], function (done) {
  browserSync.reload();
  done();
});

gulp.task('babel-watch', ['babel'], function (done) {
  browserSync.reload();
  done();
});

gulp.task('files-watch', ['files'], function (done) {
  browserSync.reload();
  done();
});

gulp.task('watch', function () {
  browserSync.init({
    proxy: 'localhost:8000',
  });

  gulp.watch(style.input, ['sass']);
  gulp.watch(js.input, ['babel-watch']);
  gulp.watch(files.app, ['files-watch']);
  gulp.watch(files.input).on("change", reload);
});
