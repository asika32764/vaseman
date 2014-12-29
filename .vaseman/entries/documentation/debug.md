layout: documentation.twig
title: Debugging

---

# Dump Data

`show()` is a helper function that can dump nested data and limit by level.

``` twig
{{ show(config) }}
```

Multiple params:

``` twig
{{ show(config, meta, foo) }}
```

If last parameter is int, it will be the limit level:

``` twig
{{ show(config, meta, foo, bar, 7) }}
```
