---
layout: documentation
title: Plugins And DataProvider

---

# Vaseman Plugin

You can create your own plugin to do something. 

> Currently, only support `DataProvideEvent`

## Create Plugin

Run this command at project root:

```shell
vaseman make:plugin Data
```

Will add this class in `.vaseman/src/Plugin/DataPlugin.php`.

```php
<?php

namespace App\Plugin;

use App\Plugin\DataLoaderTrait;
use App\Event\DataProvideEvent;
use Windwalker\Event\Attributes\EventSubscriber;
use Windwalker\Event\Attributes\ListenTo;

#[EventSubscriber]
class DataPlugin
{
    use DataLoaderTrait;

    #[ListenTo(DataProvideEvent::class)]
    public function dataProvider(DataProvideEvent $event): void
    {
        $data = &$event->getData(); // Pass by reference
        
        $faker = \Faker\Factory::create();

        $dataset = [];

        foreach (range(1, 10) as $i) {
            $dataset[] = array(
                'title' => $faker->sentence(),
                'author' => $faker->firstName . ' ' . $faker->lastName,
                'text' => $faker->paragraphs(3)
            );
        }

        $data['articles'] = $dataset;
    }
}

```

And add this class name to `config.php`

``` php
    // Plugin classes with namespace (Array)
    'plugins' => [
        App\Plugin\DataPlugin::class
    ]
```

Now we can get this articles data in Twig:

```php
@foreach ($articles as $item)
	Title: {{ $item->title }}
	Author: {{ $item->author }}
@endforeach
```
