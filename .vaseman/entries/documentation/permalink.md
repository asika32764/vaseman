layout: documentation.twig
title: Permalink

---

# Use Permalink

By default, all pages' permalink will match their file path from `/entries`.
For example, A page which at `/entries/foo/bar/baz.twig`, the url will be `/foo/bar/baz.html`.

But we can set custom permalink in page config:

``` twig
layout: html.twig
permalink: flower/sakura

---

Content Data...
```

This page will generated to `/flower/sakura.html`.

> NOTE: Permalink can only use in static pages, it will not work when we open dynamic pages.


