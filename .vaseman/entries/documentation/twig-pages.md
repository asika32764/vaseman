layout: documentation.twig
title: Use Twig Pages

---

# Create Twig Page

All pages file located in `/entries` folder, for example, we can create a page named `/entries/flower.twig` with content:

``` twig
<h1>Flower</h1>
```

Now use browser open `http://localhost/{VASEMAN_PATH}/flower.html`. You will see this output:

``` html
<h1>Flower</h1>
```

Now, we didn't generate ant static page, this is auto rendered dynamic page.

# Extends Layout

We need a HTML layout to wrap our content, there has 2 ways to extends layouts.

## Vaseman Layout Config

Add layout config on above:

``` twig
layout: html.twig
---
<h1>Flower</h1>
```

Create a `html.twig` file in `/layouts` and add `{{ content|raw }}` to show our content.

``` twig
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Site</title>
</head>
<body>
	{{ content|raw }}
</body>
</html>
```

The output is:

``` html
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Site</title>
</head>
<body>
	<h1>Flower</h1>
</body>
</html>
```

> NOTE: Layout files should all put in /layouts folder

## Twig Extends Tag

We can also use `extends` tag to wrap our content, please see [Twig Extends Tutorial](http://twig.sensiolabs.org/doc/tags/extends.html).

For example, create a file extends to `html2.twig` and a block `content` wrap our content.

``` twig
{% extends 'html2.twig' %}

{% block content %}
<h1>Flower</h1>
{% endblock %}
```

Then we have to write a `layouts/html2.twig` file.

``` twig
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Site</title>
</head>
<body>
	{% block content %}
	Default Content
	{% endblock %}
</body>
</html>
```

The output will also look like:

``` html
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Site</title>
</head>
<body>
	<h1>Flower</h1>
</body>
</html>
```
