var gulp = require('gulp'),
    concatCSS = require('gulp-concat-css'),
    browserSync = require('browser-sync').create(),
    sourcemaps = require("gulp-sourcemaps"),
    concat = require("gulp-concat-js");

gulp.task('default', function() {
  return gulp.src('src/*.html')
  .pipe(gulp.dest('.'));
});
gulp.task('image', function() {
  return gulp.src(["src/*.{png,svg}", "src/**/*.{png,svg}"])
  .pipe(gulp.dest('img/'));
});

gulp.task('buildcss', function() {
  return gulp.src('src/**/*.css')
  			 .pipe(concatCSS('css/main.css'))
  			 .pipe(gulp.dest('.'));
});

gulp.task('server', function() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
        });
    gulp.watch("src/**/*.css").on('change', browserSync.stream);
    gulp.watch("*.html").on('change', browserSync.reload);
});

gulp.task("buildjs", function () {
    return gulp.src(["src/*.{js,json}", "src/**/*.{js,json}"])
        .pipe(sourcemaps.init())
          .pipe(concat({
              "target": "bundled.js", // Name to concatenate to 
              "entry": "./main.js" // Entrypoint for the application, main module 
                                   // The `./` part is important! The path is relative to 
                                   // whatever gulp decides is the base-path, in this 
                                   // example that is `./lib` 
          }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest("."));
});