---
layout: documentation.twig
title: Getting Started

---

# Installation

Use Vaseman as simple PHP site.

``` bash
composer create-project asika/vaseman vaseman 3.*
```

Use Vaseman as static page generator.

``` bash
composer global require asika/vaseman 3.*
```

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

The template file path will matches the url path.
If you go `path/to/your/page`, Vaseman will render this file as a new page.

## Base URI

Using `{{ uri.base }}` to add subfolder for assets url.

For Example, If you are in a page `foo/bar/baz.html`, You can use this url as link href:

``` twig
<a href="{{ $uri['base'] }}sakura.html">Link</a>
```

The link will render as:

``` html
<a href="../../sakura.html">Link</a>
```

So the page link will not break in every pages.
