var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var less        = require('gulp-less');
var concatCss 	= require('gulp-concat-css');
var csso        = require('gulp-csso');
var cleanCSS = require('gulp-clean-css');
var rename = require("gulp-rename");
var minify = require('gulp-minify');
var htmlmin = require('gulp-htmlmin');
const imagemin = require('gulp-imagemin');
// для правильной работы не забудьте подключить плагины к своему проекту

// Компилируем Less при помощи плагина gulp-less 
gulp.task('less', function() {

    return gulp.src("app/less/*.less") // находим все less файлы в папке less 
        .pipe(less()) // собственно компилируем их
        .pipe(csso()) // если нужно - сжимаем css код (если не нужно, строчку можно удалить)
        .pipe(concatCss('style.css')) // при желании можно объединить все в один css-файл 
        .pipe(gulp.dest("app/css/")) // выгружаем файлы в папку app в раздел css 
        .pipe(browserSync.stream()); // при желании можно обновить browser-sync после изменений
});
gulp.task('imgmin', function () {
    var paths = [
  "app/img/*", 
  "app/video/*.jpeg",
  "app/video/*.jpg",
  "app/video/*.gif",
  "app/video/*.png"
];
    return gulp.src(paths, {base: "./"})
        .pipe(imagemin())
        .pipe(gulp.dest("./"));
});
gulp.task('cssmin', function () {
  return gulp.src("app/css/style.css")
  .pipe(rename("style.min.css"))  
  .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
  .pipe(gulp.dest("app/css/"));

    
});
gulp.task('jsmin', function () {
  return gulp.src('app/js/**/*.js')
    .pipe(minify({
        ext:{
            src:'.js',
            min:'.min.js'
        },        
        ignoreFiles: ['*.min.js']
    }))
    .pipe(gulp.dest('app/js/')) ; 
});

gulp.task('htmlmin', function() {
  return gulp.src('app/*.html')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest('app/'));
});
// Настраиваем сервер browser-sync для отслеживания изменений в проекте 
gulp.task('serve', ['less'], function() {
    // Запускаем сервер и указываем за какой папкой нужно следить 
    browserSync.init({
        server: "./app"
    });
    gulp.watch("app/less/*.less", ['less']); // следим за изменениями less файлов и сразу запускаем таск less 
    gulp.watch("app/*.html").on('change', browserSync.reload); // запускаем перезагрузку страницы при изменениях html 
});


gulp.task('default', ['serve']); // делаем это стандартным таском


gulp.task('cssminspec', function () {
    return gulp.src("app/less/spec/*.less") 
        .pipe(less()) 
        .pipe(csso()) 
        .pipe(concatCss('spec.min.css'))          
  .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(gulp.dest("app/css/"));   
});