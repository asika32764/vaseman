![vaseman-logo-1000](https://cloud.githubusercontent.com/assets/1639206/5567964/80ec8382-8f8a-11e4-8ada-500079753d69.png)

# The Vaseman Prototype System

[![Latest Stable Version](https://poser.pugx.org/asika/vaseman/v/stable.svg)](https://packagist.org/packages/asika/vaseman) 
[![Total Downloads](https://poser.pugx.org/asika/vaseman/downloads.svg)](https://packagist.org/packages/asika/vaseman) 
[![Latest Unstable Version](https://poser.pugx.org/asika/vaseman/v/unstable.svg)](https://packagist.org/packages/asika/vaseman) 
[![License](https://poser.pugx.org/asika/vaseman/license.svg)](https://packagist.org/packages/asika/vaseman)

Vaseman is nothing but only pretty face. He is a prototype system and static site generator.

## Installation

### Install by Download

Please download from here:
https://github.com/asika32764/vaseman/releases

### Install by Composer

``` bash
$ php composer.phar create-project asika/vaseman [project-dir] 2.*
```

## Getting Started

### View Pages

Open project dir by browser, you can see the index page.

![index](http://cl.ly/SnuG/p2013-12-05-1.jpg)

And click *Admin* button on top left, this is a back-end page example.

![admin](http://cl.ly/SoKm/p2013-12-05-2.jpg)

### Writing Pages

Just create your `*.twig` in `entries` folder.

The template file path are match the url path. If you go `path/to/your/page`, Vaseman will render `entries/path/to/your/page.twig` for you.

### Base URI

Using `{{ uri.base }}` to add subfolder for assets url.

For Example, If you put your project in `http://localhost/subfolder`

``` twig
<script src="{{ uri.base }}assets/js/main.js"></script>
```

Will render as:

``` html
<script src="/subfolder/assets/js/main.js"></script>
```

That avoid the loading failure by relative path.

### Helper

Create your own helper class in `src/Helper`:

``` php
<?php
// src/Helper/Myhelper.php

namespace Vaseman\Helper;

use Vaseman\Helper\Set\AbstractHelper as Helper;

class Myhelper extends AbstractHelper
{
    public function getSomeThing($foo = '')
    {
        return 'Something is ' . $foo;
    }
}
```

Then you can use this helper in templates:

``` twig
<div class="{{ helper.myhelper.getSomeThing('bar') }}"></div>
```

## License
GNU General Public License version 2 or later;

## Resources

### About Windwalker

https://github.com/ventoviro/windwalker

### About Twig

http://twig.sensiolabs.org/