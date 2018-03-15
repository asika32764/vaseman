---
layout: documentation.twig
title: Generate Static Pages

---

# Generate Pages In Vaseman Project

Now we create many pages in `/entries`, all pages are render dynamically. If we want to put our site on static web spaces
(like [GitHub Pages](https://pages.github.com/)), we can use command line to generate `.html` files.

Open your terminal and type:

``` bash
cd /your/vaseman/project
php bin/console
```

You will see console help:

``` bash
Vaseman - version: 3
------------------------------------------------------------

[console Help]

Vaseman console system.

Usage:
  console <command> [option]


Options:

  -h | --help       Display this help message.
  -q | --quiet      Do not output any message.
  -v | --verbose    Increase the verbosity of messages.
  --ansi            Set 'off' to suppress ANSI colors on unsupported terminals.

Commands:

  up    Generate site.

```

There is only one command now. Just type:

``` bash
php bin/console up
```

Then Vaseman will generate all pages and media files to `/output` folder:

``` bash
Vaseman generator
-----------------------------

Start generating site

Write file: /private/var/www/vaseman/output/admin/article/edit.html
Write file: /private/var/www/vaseman/output/admin/article/index.html
Write file: /private/var/www/vaseman/output/admin/category/edit.html
Write file: /private/var/www/vaseman/output/admin/category/index.html
Write file: /private/var/www/vaseman/output/article.html
Write file: /private/var/www/vaseman/output/index.html
Write file: /private/var/www/vaseman/output/media/css/bootstrap.min.css
Write file: /private/var/www/vaseman/output/media/css/project.css
Write file: /private/var/www/vaseman/output/media/fonts/glyphicons-halflings-regular.eot
Write file: /private/var/www/vaseman/output/media/fonts/glyphicons-halflings-regular.svg
Write file: /private/var/www/vaseman/output/media/fonts/glyphicons-halflings-regular.ttf
Write file: /private/var/www/vaseman/output/media/fonts/glyphicons-halflings-regular.woff
Write file: /private/var/www/vaseman/output/media/images/favicon.ico
Write file: /private/var/www/vaseman/output/media/js/bootstrap.min.js
Write file: /private/var/www/vaseman/output/media/js/jquery.js

Complete
```

Now theses files can safely put on static web spaces.

> We also provide phar file to quickly use: [Download Phar](https://github.com/asika32764/vaseman/releases)

# Folder to Generate

Open `/etc/config.php` or `/.vaseman/config.php`, you will see:

``` yaml
<?php

return [
    'project' => [
        'name' => 'Vaseman'
    ],

    // Which folders you want to generate (Array)
    'folders' => [
        'entries' => '',
        'asset' => 'asset'
    ],

    // Plugin classes with namespace (Array)
    'plugins' => [
    ],

    'system' => [
        'debug' => 0,
        'timezone' => 'UTC',
        'error_reporting' => -1,
    ],
];

```

Just add `folders` element that Vaseman will parse all files in the folders you set:

``` yaml
    'folders' => [
        'entries' => '',
        'asset' => 'asset',
        'myfolder' => 'myfolder123'
    ],
```
