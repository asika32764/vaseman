<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\File;

use Vaseman\Twig\VasemanTwigLoader;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Core\View\Twig\WindwalkerExtension;
use Windwalker\Event\Event;
use Windwalker\Filesystem\File;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;
use Windwalker\Renderer\TwigRenderer;
use Windwalker\Utilities\Queue\Priority;

/**
 * The TwigProcessor class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TwigProcessor extends AbstractFileProcessor
{
	/**
	 * Property renderer.
	 *
	 * @var  TwigRenderer
	 */
	protected $renderer;

	/**
	 * render
	 *
	 * @return  string
	 */
	public function render()
	{
		$renderer = $this->getRenderer();

		// @ loadExtensions event
		$engine = $renderer->getEngine();

		$this->loadExtensions($engine);

		// Start render
		$output = $engine->loadTemplate($this->getLayout())->render((array) $this->data);

		$this->output = $this->renderLayout($output);

		return $this->output;
	}

	/**
	 * renderLayout
	 *
	 * @param string $content
	 *
	 * @return  string
	 */
	protected function renderLayout($content = null)
	{
		$renderer = $this->getRenderer();

		$data = $this->getData();

		$data->content = $content;

		$config = new Registry($data->config);

		if (!$config['layout'])
		{
			return $content;
		}

		$output = $renderer->render($config['layout'], iterator_to_array($data));

		return $output;
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

			$paths = RendererHelper::getGlobalPaths();
			$paths->insert($this->getRoot(), Priority::HIGH);

			$loader = new VasemanTwigLoader($paths->toArray());

			$loader->setEnv($twig);
			$loader->setProcessor($this);

			$twig->setLoader($loader);
//			$twig->addExtension(new WindwalkerExtension(Ioc::factory()));

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
		$event = new Event('loadExtensions');

		$event['twig'] = $twig;

		return Ioc::getDispatcher()->triggerEvent($event);
	}

	/**
	 * Method to set property renderer
	 *
	 * @param   TwigRenderer $renderer
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setRenderer($renderer)
	{
		$this->renderer = $renderer;

		return $this;
	}

	/**
	 * Method to get property Target
	 *
	 * @return  string
	 */
	public function getTarget()
	{
		if (!$this->target)
		{
			$this->target = ltrim($this->getLayout(), '\\/');

			$this->target = File::stripExtension($this->target) . '.html';
		}

		return $this->target;
	}
}
