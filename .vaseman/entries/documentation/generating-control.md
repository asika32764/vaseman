---
layout: documentation
title: Generating Control

---

# The Folders to Generate

There has a global config file `config.php` as `.vaseman` folder.

Open `/.vaseman/config.php`, you will see:

``` php
<?php

return [
    'project' => [
        'name' => 'Vaseman'
    ],

    // Which folders you want to generate (Array)
    'folders' => [
        'entries' => '',
    ],

    'links' => [
        'assets' => 'assets'
    ],

    // Plugin classes with namespace (Array)
    'plugins' => [
        //
    ],

    'system' => [
        'debug' => 0,
        'timezone' => 'UTC',
        'error_reporting' => -1,
    ],
];

```

Just add `folders` element that Vaseman will parse all files in the folders you set:

``` php
    'folders' => [
        'entries' => '',
        'myfolder' => 'myfolder123'
    ],
```

# Link Folders

Sometimes, the assets may be very large and has a huge file numbers. It will slow down the generating performance.

Use folder links when developing, Vaseman will create symlink instead copy files.

```php
    'links' => [
        'assets' => 'assets'
    ],
```

When you completed your developing, just add `--hard` to up command:

```shell
vaseman up --hard
```

Then Vaseman will hard copy all assets files to public folder. 

# Watch Files

Default project has a `gulpfile.mjs`, you can use Gulp to watch files and auto build.

You must install `gulp-cli` globally.

```shell
npm i -g glup-cli
```

```shell
cd .vaseman

npm install
# OR
yarn install

gulp watch
```
