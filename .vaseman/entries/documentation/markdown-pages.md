---
layout: documentation
title: Use Markdown Pages

---

# Create Markdown Pages

Create Markdwon page is very easy, just put your `.md` files in `/entries`.

This is an example of `/entries/foo/sakura.md`.

``` markdown
---
layout: global.html
---
# Sakura

Sakura page
```

Don't miss `layout` config because we have to wrap markdown data with a HTML template.

Run: 

```shell
vaseman up
```

Open `{VASEMAN_PATH}/foo/sakura.html`, you will see:

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

# Use Markdown In Blade Page

We can also render markdown in twig page, use `@markdown` directive:

```php
<div class="article-content">
@markdown
	
# Markdown Page

Test Data ![img](foo.jpg)

@endmarkdown
</div>
```
