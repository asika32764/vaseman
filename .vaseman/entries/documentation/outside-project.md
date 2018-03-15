---
layout: documentation.twig
title: Generate Static Pages

---

# Use Vaseman As CLI Tools

Vaseman can use as a CLI tools to generate multiple projects, that we don't necessary to clone Vaseman for every project.

``` bash
composer global require asika/vaseman 3.*
```

Make sure your composer bin folder is in your system `PATH` env variable.

Now, type `vaseman` in everywhere, Vaseman will be a global command:

``` bash
> vaseman

Vaseman - version: 2.0
------------------------------------------------------------

[vaseman Help]

Vaseman console system.

Usage:
  vaseman <command> [option]


Options:

  -h | --help       Display this help message.
  -q | --quiet      Do not output any message.
  -v | --verbose    Increase the verbosity of messages.
  --ansi            Set 'off' to suppress ANSI colors on unsupported terminals.

Commands:

  up      Generate site.
  init    Initialise a site project.

```

Note there is a new `init` command if we use Vaseman as global tools.

## Initialise A New Project

Type these commands.

``` bash
mkdir mysite
cd mysite
vaseman init
```

Vaseman will create default pages:

``` bash
This action will remove all current files, are you sure to continue? [Y/n]: y

Start initialise Vaseman project.

Create: /private/var/www/test/mysite/.vaseman/media
Create: /private/var/www/test/mysite/.vaseman/entries
Create: /private/var/www/test/mysite/.vaseman/layouts
Create: /private/var/www/test/mysite/.vaseman/config.yml
Create: /private/var/www/test/mysite/.vaseman/src/Plugin
Create: /private/var/www/test/mysite/.vaseman/src/Helper
Create: /private/var/www/test/mysite/.vaseman/src/Twig

Project generated.

```

## Generate Pages

Generate pages in outer project is same as inner project:

``` bash
$ vaseman up
```

Then Vaseman will generate all pages to root.

``` bash
Vaseman generator
-----------------------------

Start generating site

Write file: /private/var/www/test/mysite/admin/article/edit.html
Write file: /private/var/www/test/mysite/admin/article/index.html
Write file: /private/var/www/test/mysite/admin/category/edit.html
Write file: /private/var/www/test/mysite/admin/category/index.html
Write file: /private/var/www/test/mysite/article.html
Write file: /private/var/www/test/mysite/index.html
Write file: /private/var/www/test/mysite/media/css/bootstrap.css
Write file: /private/var/www/test/mysite/media/css/project.css
Write file: /private/var/www/test/mysite/media/fonts/glyphicons-halflings-regular.eot
Write file: /private/var/www/test/mysite/media/fonts/glyphicons-halflings-regular.svg
Write file: /private/var/www/test/mysite/media/fonts/glyphicons-halflings-regular.ttf
Write file: /private/var/www/test/mysite/media/fonts/glyphicons-halflings-regular.woff
Write file: /private/var/www/test/mysite/media/images/favicon.ico
Write file: /private/var/www/test/mysite/media/js/bootstrap.js
Write file: /private/var/www/test/mysite/media/js/jquery.js

Complete

```

## Watch Files

Vaseman provides a simple gulp watch task. please cd to `.vaseman` folder, first run:

```bash
npm install
```

OR

```bash
yarn install
```

Then run `gulp watch`, and the Gulp will auto re-build files after you modified any file.
