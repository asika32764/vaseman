layout: documentation.twig
title: View Helpers

---

# View Helper For Twig

We cannot use php functions in Twig, so if we want to add custom functions, there is a way to add some helpers.

## Create Helper

Add this class in `src/Vaseman/Helper/BlogHelper.php` or `src/Helper/BlogHelper.php` in outer project.

``` php
<?php

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

class BlogHelper extends AbstractHelper
{
	public function getData($date = 'now')
	{
		return new \DateTime($date);
	}
}
```

Now we can use this method in Twig:

``` twig
Created date: {{ helper.blog.getDate('now') }}
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
