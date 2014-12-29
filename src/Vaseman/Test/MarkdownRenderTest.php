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
use Windwalker\Environment\PhpHelper;
use Windwalker\Ioc;

/**
 * The PageRenderTest class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MarkdownRenderTest extends AbstractBaseTestCase
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
		if (PhpHelper::isHHVM())
		{
			// @link https://github.com/ventoviro/windwalker/issues/149
			$this->markTestSkipped('Test package not support HHVM now.');
		}

		$this->controller = new GetController(null, Ioc::getApplication(), Ioc::factory(), PackageHelper::getPackage('vaseman'));
	}

	/**
	 * testMarkdown
	 *
	 * @return  void
	 */
	public function testMarkdown()
	{


		$this->controller->getInput()->set('paths', array('olive', 'index'));

		$compare = <<<HTML
<h2>Hello World</h2>
<p>test data</p>
<p><img src="img.jpg" alt="img" /></p>
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}

	/**
	 * testWithLayout
	 *
	 * @return  void
	 */
	public function testWithLayout()
	{
		$this->controller->getInput()->set('paths', array('olive', 'layout'));

		$compare = <<<HTML
<p>
	<h2>Hello World</h2>
	<p>test data</p>
	<p><img src="img.jpg" alt="img" /></p>
</p>
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}
}
