---
layout: documentation.twig
title: View Helpers

---

# View Helper

We cannot use php functions in Twig, so if we want to add custom functions, there is a way to add some helpers.

## Create Helper

Add this class in `src/Vaseman/Helper/BlogHelper.php` or `src/Helper/BlogHelper.php` in outer project.

``` php
<?php

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

class BlogHelper extends AbstractHelper
{
	public function getData($date = 'now', $format = 'Y-m-d H:i:s')
	{
		return (new \DateTime($date))->format($format);
	}
}
```

Now we can use this method in Twig:

``` twig
{# Twig #}
Created date: {{ helper.blog.getDate('now') }}
```

```php
{{-- Blade --}}
Created date: {{ $helper->blog->getDate('now') }}
```

In Blade, you can simply use php class:

```php
<a class="nav-link {{ \MyProject\Helper\MyClass::isActive($path, 'foo') }}">...</a>
```

# Fake Data

Vaseman includes [PHP Faker](https://github.com/fzaninotto/Faker) to help you generate random fake data.

``` php
<?php

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

class BlogHelper extends AbstractHelper
{
	public function getSeeder()
	{
		$faker = \Faker\Factory::create();

		return array(
			'title' => $faker->sentence(),
			'author' => $faker->firstName . ' ' . $faker->lastName,
			'text' => $faker->paragraphs(3)
		);
	}
}
```
