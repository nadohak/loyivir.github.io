var gulp = require('gulp'),
    browserSync = require('browser-sync').create();


gulp.task('default', function() {
    browserSync.init({
        server: {
            baseDir: "."
        }
        });
    gulp.watch("css/*.css").on('change', browserSync.stream);
    gulp.watch("*.html").on('change', browserSync.reload);
});