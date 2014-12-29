layout: documentation.twig
title: Plugins And DataProvider

---

# Create Plugin

Create this class in `src/Vaseman/Plugin/DataPlugin.php` or `src/Plugin/DataPlugin.php` in outer project.

The `DataProviderInterface` force add a `loadProvider()` method to return data.

``` php
<?php

namespace Vaseman\Plugin;

use Windwalker\Event\Event;

class DataPlugin extends AbstractPlugin implements DataProviderInterface
{
	public function loadProvider(Event $event)
	{
		$faker = \Faker\Factory::create();

		$dataset = array();

		foreach (range(1, 10) as $i)
		{
			$dataset[] = array(
				'title' => $faker->sentence(),
				'author' => $faker->firstName . ' ' . $faker->lastName,
				'text' => $faker->paragraphs(3)
			);
		}

		// $event['data'] is the context data which will be send into Twig
		$event['data']->articles = $dataset;
	}
}

```

And add this namespace to `config.yml`

``` yaml
# Plugin classes with namespace (Array)
plugins:
    - Vaseman\Plugin\DataPlugin
```

Now we can get this articles data in Twig:

``` twig
{% for (item in articles) %}
	Title: {{ item.title }}
	Author: {{ item.author }}
{% endfor %}
```