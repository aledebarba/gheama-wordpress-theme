const { task } = require('gulp');
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

// complile scss into css 
function frontEndStyles() {
    return gulp.src('./assets/style/scss/style.scss')
    .pipe(sass())
    .pipe(gulp.dest('./assets/style').on('error', sass.logError))
    .pipe(browserSync.stream())
}
task(frontEndStyles)

function panelStyles() {
    return gulp.src('./assets/style/scss/acf_custom.scss')
    .pipe(sass())
    .pipe(gulp.dest('./assets/style', {outputStyle:'compressed'}).on('error', sass.logError))
    .pipe(browserSync.stream())
}
task(panelStyles)

task('serve', function() {
    browserSync.init(
        {
            proxy: "gheama.test"
        }
    )    
    
    gulp.watch('**/*.php').on('change', browserSync.reload );
    
    gulp.watch('**/*.scss').on('change', (_path, _stats)=>{
        frontEndStyles();
        panelStyles();
        browserSync.reload;
    });
    
})

gulp.task('default', gulp.series( frontEndStyles, panelStyles, ['serve'] ) );
