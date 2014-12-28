<?php
/**
 * Part of vaseman project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Test;

use Vaseman\Controller\Page\GetController;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Test\AbstractBaseTestCase;
use Windwalker\Ioc;

/**
 * The PageRenderTest class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TwigRenderTest extends AbstractBaseTestCase
{
	/**
	 * Property controller.
	 *
	 * @var GetController
	 */
	protected $controller;

	/**
	 * setUp
	 *
	 * @return  void
	 */
	public function setUp()
	{
		$this->controller = new GetController(null, Ioc::getApplication(), Ioc::factory(), PackageHelper::getPackage('vaseman'));
	}

	/**
	 * testExtends
	 *
	 * @return  void
	 */
	public function testExtends()
	{
		$this->controller->getInput()->set('paths', array('flower', 'extends'));

		$compare = <<<HTML
<p id="parent">
	Hello World
</p>
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}

	/**
	 * testMarkdown
	 *
	 * @return  void
	 */
	public function testMarkdown()
	{
		$this->controller->getInput()->set('paths', array('flower', 'markdown'));

		$compare = <<<HTML
<h1>Test Heading</h1>
<p>This is paragraph</p>
<p><a href="foo.html">This is link</a></p>
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}
}
