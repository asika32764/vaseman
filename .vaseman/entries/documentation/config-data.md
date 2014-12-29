layout: documentation.twig
title: Config And Data

---

# Add Page Config

We can use [YAML](http://www.yaml.org/) format at top of every page to set config. Separate config and content by 3 dashes (`---`).

For Example:

``` twig
layout: html.twig
title: My Site
flower:
    sakura: World

---
<html lang="en">
<head>
	<title>{{ config.title }}</title>
</head>
<body>
    Hello {{ config.flower.sakura }}
</body>
</html>
```

All config data will put in `config` property.

# Page Properties

There has some default properties in every twig pages.

| Name | Description |
| ---- | ----------- |
| config | All config data at page header |
| uri    | Contains `uri.base` and `uri.media` to set relative link path |
| view   | Some view and layout properties |
| path   | An array or current route |
| content | The page data |
