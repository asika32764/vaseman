<?php

namespace App\Plugin;

use App\Event\DataProvideEvent;
use Windwalker\Event\Attributes\EventSubscriber;
use Windwalker\Event\Attributes\ListenTo;

#[EventSubscriber]
class HelloPluginPlugin
{
    #[ListenTo(DataProvideEvent::class)]
    public function dataProvider(DataProvideEvent $event): void
    {
        $data = &$event->getData();
    }
}