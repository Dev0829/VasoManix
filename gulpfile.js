/** Dependecies **/
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var notify = require("gulp-notify");
var plumber = require("gulp-plumber");
var jsImports = require("gulp-imports");

//variables


// Compile Sass & Inject Into Browser
gulp.task('sass', function () {
    return gulp.src(['src/scss/style.scss'])
        .pipe(plumber(msgERROR))
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(autoprefixer({browsers: ['last 3 versions', 'ios >= 6']}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest("web/css"))
        .pipe(browserSync.stream())
        .pipe(notify(msgSASS));

});



gulp.task('uglify', function () {
    gulp.src('src/js/*.js')

        .pipe(gulp.dest('web/js'))
});

gulp.task('js', function () {
    gulp.src('src/js/app.js')
        .pipe(plumber(msgERROR))
        .pipe(sourcemaps.init())
        .pipe(jsImports())
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('web/js'))
        .pipe(notify(msgJS))
});

gulp.task('scripts', ['js'], function (done) {
    browserSync.reload();
    done();
});



//error notification settings for plumber
var msgERROR = {
    errorHandler: notify.onError({
        title  : 'Fix that ERROR, bitch:',
        message: "<%= error.message %>",
        /*icon   : path.join(__dirname, 'config/error.png'),*/
        time   : 2000
    })
};

var msgSASS = {
    title  : 'Sweet! :)',
    message: 'Styles are compiled!',
    /*icon   : path.join(__dirname, 'config/styles.png'),*/
    time   : 400,
    sound  : false,
    onLast : true
};
var msgJS = {
    title  : 'Awesome! :)',
    message: 'Script is compiled!',
    /*icon   : path.join(__dirname, 'config/script.png'),*/
    time   : 400,
    sound  : false,
    onLast : true
};


// Watch Sass & Serve
gulp.task('serve', ['sass'], function () {
    browserSync.init({
        proxy: "localhost",
        port: 8080,
    });
    gulp.watch(['src/scss/**'], ['sass']);
   gulp.watch(['src/js/*'], ['scripts']);
    gulp.watch(['views/**']).on('change', browserSync.reload)
});


// Default Task
gulp.task('default', ['serve']);