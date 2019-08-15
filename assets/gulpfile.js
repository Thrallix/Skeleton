console.log('Starting compiling process...');

const gulp = require('gulp');
const jsmn = require('gulp-uglify');
const sass = require('gulp-sass');

let src         = './resources/src';
let dist        = './resources/dist';
let bootstrap   = './node_modules/bootstrap';
let custom      = './resources/src/scss';

//Configure options
let scss = {
    in: src + '/scss/main.scss',
    out: dist,
    watch: src + '/scss/*',
    watchjs: src + '/js/*.js',
    sassOps: {
        outputStyle: 'compressed',
        precision: 3,
        errLogToConsole: true,
        includePaths: [bootstrap + '/scss']
    }
};

//Default task
gulp.task('compile', function() {
    return gulp.src(scss.in)
        .pipe(sass(scss.sassOps))
        .pipe(gulp.dest(scss.out));
});

gulp.task('compress', function() {
    return gulp.src([src + '/js/*.js'])
        .pipe(jsmn())
        .pipe(gulp.dest(dist));
});

gulp.task('watch', function() {
    gulp.watch([scss.watchjs, scss.watch], gulp.parallel('compile', 'compress'));
});

