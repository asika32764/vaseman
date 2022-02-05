---
layout: documentation
title: View Helpers

---

# View Helper

Vaseman provides a set of Helper that you can use and extend.

## Create Helper

Run this command at project root:

```shell
vaseman make:helper Hello
```

Will add this class in `.vaseman/src/Helper/HelloHelper.php`.

``` php
<?php

namespace App\Helper;

class HelloHelper
{
    public function __construct(protected HelperSet $parent) 
    {
        //
    }
}

```

Add your own methods

```php
    // ...
    
    public function getDate($date = 'now', $format = 'Y-m-d H:i:s')
    {
        return (new \DateTime($date))->format($format);
    }

    // ...
```

Now we can use this method in Blade:

```php
Created date: {{ $helper->hello->getDate('now') }}
```

In Blade, you can simply use php static call:

```php
<a class="nav-link {{ \App\Helper\MyClass::isActive($path, 'foo') }}">...</a>
```

# Fake Data

Vaseman includes [PHP Faker](https://github.com/fzaninotto/Faker) to help you generate random fake data.

``` php
<?php

namespace App\Helper;

class FakerHelper
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
