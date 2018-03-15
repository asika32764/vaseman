var gulp = require('gulp');
var process = require('child_process');

gulp.task('build', function() {
  process.exec('vaseman up ..', function(err, stdout, stderr) {
    console.log(stdout);
  });
});

gulp.task('watch', function() {
  var rebuildWatches = [
    'entries/**/*',
    'layouts/**/*',
    'asset/**/*'
  ];

  gulp.watch(rebuildWatches, ['build']);
});

gulp.task('default', ['watch']);
