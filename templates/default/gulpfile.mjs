import gulp from 'gulp';
import process from 'child_process';

const { watch: gulpWatch } = gulp;

export async function build() {
  process.exec('vaseman up ..', function(err, stdout, stderr) {
    console.log(stdout);
  });
}

export async function watch() {
  const rebuildWatches = [
    'entries/**/*',
    'layouts/**/*',
    'assets/**/*'
  ];

  gulpWatch(rebuildWatches, build);
}

export default build;
