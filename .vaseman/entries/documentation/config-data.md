---
layout: documentation
title: Config And Data
---

# Add Page Config

We can use [YAML](http://www.yaml.org/) format at top of every page to set config. Separate config and content by 3 dashes (`---`).

For Example:

``` twig
---
layout: global.html
title: My Site
flower:
    sakura: World

---
<html lang="en">
<head>
	<title>{{ $config['title'] ?? '' }}</title>
</head>
<body>
    Hello {{ $config['flower']['sakura'] }}
</body>
</html>
```

All config data will put in `config` property.

# Page Properties

There has some global properties in every blade pages.

| Name        | Description                                                      |
|-------------|------------------------------------------------------------------|
| `$config`   | All config data at page header                                   |
| `$uri`      | Contains `path`, `route`, `routeArray` to set relative link path |
| `$asset`    | Contains `path` to set relative assets path                      |
| `$template` | Some view and layout properties                                  |
| `$content`  | The page data                                                    |

## $config

`$config` is a pure array to get configs data which merges global `config.php` and page header configs.

```php
// Get data
{{ $config['foo'] }}

// Get data or default
{{ $config['bar']['yoo'] ?? '' }}
```

## $uri

`$uri` is to get path info:

```html
<a href="{{ $uri->path }}">
    Home
</a>
<a href="{{ $uri->path() }}hello.html">
    Hello
</a>
<a href="{{ $uri->path('foo/bar.html') }}">
    Bar
</a>

{{ $uri->route }}

{{ count($uri->routeArray) }}
```

## $asset

`$asset` is similar to `$uri`, use to get assets path:

```html
<link rel="stylesheet" href="{{ $asset->path }}css/foo.css"/>
<link rel="stylesheet" href="{{ $asset->path() }}css/foo.css"/>
<script src="{{ $asset->path('js/foo.js') }}"></script>
```

## $template

`$template` has all information about current page.

See: https://github.com/asika32764/vaseman/blob/master/src/Data/Template.php

## $content

If current page is Markdown, `$content` will be rendered content:

```html
{!! $content !!}
```
