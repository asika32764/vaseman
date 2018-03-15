<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Plugin;

use Vaseman\Test\src\Twig\TestTwigExtension;
use Windwalker\Event\Event;

/**
 * The TestPlugin class.
 *
 * @since  {DEPLOY_VERSION}
 */
class TestPlugin extends AbstractPlugin implements DataProviderInterface, ExtensionProviderInterface
{
    /**
     * onContentPrepareData
     *
     * @param   Event $event
     *
     * @return  void
     */
    public function loadProvider(Event $event)
    {
        $event['data']->name = 'Flower';
    }

    /**
     * loadExtension
     *
     * @param Event $event
     *
     * @return  void
     */
    public function loadExtensions(Event $event)
    {
        $event['twig']->addExtension(new TestTwigExtension);
    }
}
