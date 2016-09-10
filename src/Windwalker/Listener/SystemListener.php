<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Listener;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\View\HtmlView;
use Windwalker\Event\Event;
use Windwalker\Http\Response\HtmlResponse;

/**
 * The SystemListener class.
 *
 * NOTE: This listener has been registered after onAfterInitialise event. So the first event is onAfterRouting.
 *
 * @since  2.1.1
 */
class SystemListener
{
	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
		/** @var WebApplication $app */
		$app = $event['app'];

		// Remove index.php
		if ($app->uri->script == 'index.php')
		{
			$app->uri->script = null;
		}
	}

	/**
	 * onBeforeRouting
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onBeforeRouting(Event $event)
	{
		/** @var WebApplication $app */
		$app = $event['app'];

		if ($app->get('system.offline', false) && !$app->get('system.debug'))
		{
			$app->server->setHandler(function (RequestInterface $request, ResponseInterface $response, callable $next = null)
			{
				$view = new HtmlView;
				$view->setLayout('windwalker.offline.offline');

				return new HtmlResponse($view->render());
			});

			$app->server->listen();

			die;
		}
	}
}
