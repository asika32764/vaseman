<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Processor;

use Vaseman\Twig\VasemanTwigLoader;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Event\Event;
use Windwalker\Filesystem\File;
use Windwalker\Ioc;
use Windwalker\Renderer\TwigRenderer;
use Windwalker\Structure\Structure;
use Windwalker\Utilities\Queue\PriorityQueue;

/**
 * The TwigProcessor class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TwigProcessor extends AbstractEngineProcessor
{
	/**
	 * render
	 *
	 * @return  string
	 */
	public function doRender()
	{
		$renderer = $this->getRenderer();

		return $renderer->getEngine()->loadTemplate($this->getLayout())->render((array) $this->data);
	}

	/**
	 * Method to get property Renderer
	 *
	 * @return  TwigRenderer
	 */
	public function getRenderer()
	{
		if (!$this->renderer)
		{
			$renderer = RendererHelper::getTwigRenderer();

			$twig = $renderer->getEngine();

			$renderer->addPath($this->getRoot(), PriorityQueue::HIGH);

			$loader = new VasemanTwigLoader($renderer->getPaths()->toArray());

			$loader->setEnv($twig);
			$loader->setProcessor($this);

			$twig->setLoader($loader);

			// @ loadExtensions event
			$this->loadExtensions($twig);

			$this->renderer = $renderer;
		}

		return $this->renderer;
	}

	/**
	 * loadExtensions
	 *
	 * @param \Twig_Environment $twig
	 *
	 * @return  Event
	 */
	protected function loadExtensions(\Twig_Environment $twig)
	{
		// @ loadExtensions event
		$event = new Event('loadTwigExtensions');

		$event['twig'] = $twig;

		return Ioc::getDispatcher()->triggerEvent($event);
	}
}
