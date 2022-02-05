/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

import { src, symlink } from '@windwalker-io/fusion';
import fs from 'fs';
import path from 'path';

export async function installVendors(npmVendors, to = 'assets/vendor') {
  const root = to;
  let vendors = npmVendors;

  if (!fs.existsSync(root)) {
    fs.mkdirSync(root);
  }

  const dirs = fs.readdirSync(root, { withFileTypes: true })
    .filter(d => d.isDirectory())
    .map(dir => path.join(root, dir.name));

  dirs.unshift(root);

  dirs.forEach((dir) => {
    deleteLinks(dir);
  });
  
  vendors = [...new Set(vendors)];

  vendors.forEach((vendor) => {
    if (fs.existsSync(`node_modules/${vendor}/`)) {
      console.log(`[Link NPM] node_modules/${vendor}/ => ${root}/${vendor}/`);
      src(`node_modules/${vendor}/`).pipe(symlink(`${root}/${vendor}`));
    }
  });

  console.log(`[Link Local] resources/assets/vendor/**/* => ${root}/`);
  src('resources/assets/vendor/*').pipe(symlink(`${root}/`));
}

function deleteLinks(dir) {
  const links = fs.readdirSync(dir, { withFileTypes: true })
    .filter(d => d.isSymbolicLink());

  links.forEach((link) => {
    fs.unlink(path.join(dir, link.name), () => {});
  });

  fs.rmdir(dir, () => {});
}
