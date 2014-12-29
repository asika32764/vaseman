layout: documentation.twig
title: Twig Extensions

---

# Create A TwigExtension Plugin

See [Plugin Section](plugins.html)

``` php
<?php

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
```

