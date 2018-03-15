---
layout: documentation.twig
title: Use Markdown Pages

---

# Create Markdown Pages

Create Markdwon page is very easy, just put your `.md` files in `/entries`.

This is an example of `/entries/foo/sakura.md`.

``` markdown
---
layout: html.twig
---
# Sakura

Sakura page
```

Do not miss `layout` config because we have to wrap markdown data with a HTML template.

Open `http://localhost/{VASEMAN_PATH}/foo/sakura.html`, you will see:

``` html
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Site</title>
</head>
<body>
	<h1>Sakura</h1>

	<p>Sakura page</p>
</body>
</html>
```

# Use Markdown In Twig and Blade Page

We can also render markdown in twig page, use `{% markdown %}` tag:

``` twig
<div class="article-content">
	{% markdown %}
	
# Markdown Page

Test Data ![img](foo.jpg)

	{% endmarkdown %}
</div>
```

In Blade

```php
<div class="article-content">
	@markdown
	
# Markdown Page

Test Data ![img](foo.jpg)

	@endmarkdown
</div>
```
