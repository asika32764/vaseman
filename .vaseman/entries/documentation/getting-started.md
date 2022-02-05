---
layout: documentation
title: Getting Started

---

# Installation

Install Vaseman globally. 

``` bash
composer global require asika/vaseman
```

# Init a Project

To init a project, use this commands:

```shell
mkdir site
vaseman init site
```

Init with custom template:

```shell
vaseman init {dir} /path/to/template 
```

Init with custom template on GitHub:

```shell
vaseman init {dir} git@github.com:{org}/vaseman-my-template.git
```

Vaseman will create a `.vaseman` folder to store project file.

And the current folder will be public folder.

# Render Pages

Type:

```shell
vaseman up
```

Then the pages will render to HTML.

```shell
Start generating site
=====================

[Prepare]: index.blade.php
[Prepare]: article/markdown.md
[Prepare]: article/article.blade.php
[Rendered]: index.html
[Rendered]: article/article.html
[Rendered]: article/markdown.html
[Link]: assets
```

Open the `index.html`, you will see project home page.

# Default Pages

Now we can use browser open Vaseman root, Vaseman will render page dynamically.

## View Pages

Open project dir by browser, you can see the index page.

![index](https://i.imgur.com/pSp7y4K.jpg)

Click the grey buttons at below content, you can see an sample article page. (`entries/article/article.blade.php`)

![](https://i.imgur.com/jK4fGKy.jpg)

Click Markdown link at sidebar, you will see a markdown page example. (`entries/article/markdown.md`)

![](https://i.imgur.com/ryldijh.jpg)

## Create Pages

Create your `*.blade.php` in `entries` folder.

The template file path will match the url path.
If you go `path/to/your/page`, Vaseman will render this file as a new page.

## Base URI

Using `{{ $uri->path() }}` to add subfolder for assets url.

For Example, If you are in a page `foo/bar/baz.html`, You can use this url as link href:

``` twig
<a href="{{ $uri->path() }}sakura.html">Link</a>
```

The link will render as:

``` html
<a href="../../sakura.html">Link</a>
```

So the page link will not break in every pages.
