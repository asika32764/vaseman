<?php
/**
 * Part of Vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Plugin;

use Windwalker\Event\Event;

class TwigExtensionPlugin extends AbstractPlugin implements ExtensionProviderInterface
{
	public function loadExtensions(Event $event)
	{
		/** @var \Twig_environment $twig */
		$twig = $event['twig'];

		$twig->addExtension(new MyTwigExtension);
	}
}
