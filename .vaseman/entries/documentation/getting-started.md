layout: documentation.twig
title: Getting Started

---

# Installation

## Install by Download

Please download from [Github](https://github.com/asika32764/vaseman/releases)

## Install by Composer

``` bash
$ php composer.phar create-project asika/vaseman vaseman 2.*
```

# Default Pages

Now we can use browser open Vaseman root, Vaseman will redner page dynamically.

## View Pages

Open project dir by browser, you can see the index page.

![index](http://cl.ly/SnuG/p2013-12-05-1.jpg)

And click *Admin* button on top left, this is a back-end page example.

![admin](http://cl.ly/SoKm/p2013-12-05-2.jpg)

## Writing Pages

Create your `*.twig` in `entries` folder.

The template file path will matches the url path.
If you go `path/to/your/page`, Vaseman will render `entries/path/to/your/page.twig` for you.

## Base URI

Using `{{ uri.base }}` to add subfolder for assets url.

For Example, If you are in a page `foo/bar/baz.html`, You can use this url as link href:

``` twig
<a href="{{ uri.base }}sakura.html">Link</a>
```

The link will render as:

``` html
<a href="../../sakura.html">Link</a>
```

So the page link will not break in every pages.
