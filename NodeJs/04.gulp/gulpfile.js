/**
 * Created by dllo on 16/11/24.
 */
const gulp = require("gulp");
const uglify = require("gulp-uglify");

gulp.task("script",function () {
    gulp.src("js/*.js").pipe(uglify()).pipe(gulp.dest("dest/js"));
});
gulp.task("auto",function () {
    gulp.watch("js/*.js",["script"]);
});