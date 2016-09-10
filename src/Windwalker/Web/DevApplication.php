<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Web;

use Psr\Http\Message\ServerRequestInterface as Request;
use Windwalker\Environment\WebEnvironment;
use Windwalker\Structure\Structure;
use Windwalker\Core\Provider;

/**
 * The DevApplication class.
 * 
 * @since  2.1.1
 */
class DevApplication extends Application
{
	/**
	 * Property mode.
	 *
	 * @var  string
	 */
	protected $name = 'dev';

	/**
	 * Class constructor.
	 *
	 * @param   Request        $request       An optional argument to provide dependency injection for the Http request object.
	 * @param   Structure      $config        An optional argument to provide dependency injection for the application's
	 *                                        config object.
	 * @param   WebEnvironment $environment   An optional argument to provide dependency injection for the application's
	 *                                        environment object.
	 *
	 * @since   2.0
	 */
	public function __construct(Request $request = null, Structure $config = null, WebEnvironment $environment = null)
	{
		parent::__construct($request, $config, $environment);

		$this->boot();
	}
}
