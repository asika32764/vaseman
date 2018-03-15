---
layout: documentation.twig
title: Debugging

---

# Dump Data

`show()` is a helper function that can dump nested data and prevent the infinite loop.

You can use this function in both blade and twig.

``` php
{{ show($config) }}
```

Multiple params:

``` php
{{ show($config, $meta, $foo) }}
```

If last parameter is int, it will be the limit level:

``` php
{{ show($config, $meta, $foo, $bar, 7) }}
```
