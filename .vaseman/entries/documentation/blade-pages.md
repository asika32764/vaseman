---
layout: documentation
title: Use Blade Pages

---

# Create Blade Page

Vaseman uses [Edge](https://github.com/ventoviro/windwalker-edge) as Blade compatible template engines, you can use most of all Blade directives.

All pages file located in `/entries` folder, for example, we can create a page named `/entries/flower.blade.php` with content:

``` html
<h1>Flower</h1>
```

Then run:

```shell
vaseman up
```

Now use browser to open `{VASEMAN_PATH}/flower.html`. You will see this output:

``` html
<h1>Flower</h1>
```

We didn't generate any static page, this is auto rendered dynamic page.

# Extends Layout

We need a HTML layout to wrap our content, there has 2 ways to extends layouts.

## Extend Layouts

Add layout config on above:

```php
---
layout: _global/html
---
<h1>Flower</h1>
```

Or use Blade extends syntax:

```php
@extends('global.html')

@section('content')
<h1>Flower</h1>
@stop
```

All layout file located in `layouts` folder.

## Print Content

Use Blade directive to show extended section in global html file.

```php
@yield('content', 'Content')

OR

@section('content')

@show
```

If you use `layout: xxx/xxx` to extend global layout, you must print `$content` variable.

```php
@section('content')
    {!! $content ?? '' !!}}
@show
```
