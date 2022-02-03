/**
 * Part of Windwalker Fusion project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

import fusion, { sass, babel, parallel } from '@windwalker-io/fusion';
import { jsSync, installVendors } from '@windwalker-io/core';

export async function css() {
  // Watch start
  fusion.watch(['resources/assets/scss/**/*.scss', 'src/Module/**/assets/*.scss']);
  // Watch end

  // Compile Start
  sass(
    [
      'resources/assets/scss/front/main.scss',
      'src/Module/Front/**/assets/*.scss'
    ],
    'www/assets/css/front/main.css'
  );
  sass(
    [
      'resources/assets/scss/admin/main.scss',
      'src/Module/Admin/**/assets/*.scss'
    ],
    'www/assets/css/admin/main.css'
  );
  // Compile end
}

export async function js() {
  // Watch start
  fusion.watch('resources/assets/src/**/*.{js,mjs}');
  // Watch end

  // Compile Start
  babel('resources/assets/src/**/*.{js,mjs}', 'www/assets/js/');
  // Compile end

  return syncJS();
}

export async function images() {
  // Watch start
  fusion.watch('resources/assets/images/**/*');
  // Watch end

  // Compile Start
  return await fusion.copy('resources/assets/images/**/*', 'www/assets/images/')
  // Compile end
}

export async function syncJS() {
  // Watch start
  fusion.watch('src/Module/**/assets/**/*.{js,mjs}');
  // Watch end

  // Compile Start
  const { dest } = await jsSync(
    'src/Module/',
    'www/assets/js/view/'
  );

  babel(dest.path + '**/*.{mjs,js}');
  // Compile end

  return Promise.all([]);
}

export async function install() {
  return installVendors([
    'bootstrap'
  ]);
}

export default parallel(css, js, images);

/*
 * APIs
 *
 * Compile entry:
 * fusion.js(source, dest, options = {})
 * fusion.babel(source, dest, options = {})
 * fusion.module(source, dest, options = {})
 * fusion.ts(source, dest, options = {})
 * fusion.typeScript(source, dest, options = {})
 * fusion.css(source, dest, options = {})
 * fusion.sass(source, dest, options = {})
 * fusion.copy(source, dest, options = {})
 *
 * Live Reload:
 * fusion.livereload(source, dest, options = {})
 * fusion.reload(file)
 *
 * Gulp proxy:
 * fusion.src(source, options)
 * fusion.dest(path, options)
 * fusion.watch(glob, opt, fn)
 * fusion.symlink(directory, options = {})
 * fusion.lastRun(task, precision)
 * fusion.tree(options = {})
 * fusion.series(...tasks)
 * fusion.parallel(...tasks)
 *
 * Stream Helper:
 * fusion.through(handler) // Same as through2.obj()
 *
 * Config:
 * fusion.disableNotification()
 * fusion.enableNotification()
 */
