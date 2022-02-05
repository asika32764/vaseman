<?php

namespace App\Plugin;

use App\Plugin\DataLoaderTrait;
use App\Event\DataProvideEvent;
use Windwalker\Event\Attributes\EventSubscriber;
use Windwalker\Event\Attributes\ListenTo;

#[EventSubscriber]
class MenuPlugin
{
    use DataLoaderTrait;

    #[ListenTo(DataProvideEvent::class)]
    public function dataProvider(DataProvideEvent $event): void
    {
        $data = &$event->getData();

        $data['menus'] = $this->loadYaml(__DIR__ . '/../../resources/menu/menus.yml');
    }
}
