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
class PageRenderTest extends AbstractBaseTestCase
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
	 * testNoConfig
	 *
	 * @return  void
	 */
	public function testNoConfig()
	{
		$this->controller->getInput()->set('paths', array('no-config'));

		$compare = <<<HTML
No config Twig file
uri.base:
uri.media: media/
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}

	/**
	 * testNoConfig
	 *
	 * @return  void
	 */
	public function testHasConfig()
	{
		$this->controller->getInput()->set('paths', array('has-config'));

		$compare = <<<HTML
Has config Twig file
uri.base:
uri.media: media/
config.foo.bar: baz
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}

	/**
	 * testSubfolder
	 *
	 * @return  void
	 */
	public function testSubfolder()
	{
		$this->controller->getInput()->set('paths', array('sakura', 'index'));

		$compare = <<<HTML
File: sakura/index
uri.base: ../
uri.media: ../media/
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());
	}

	/**
	 * testPermalink
	 *
	 * @return  void
	 */
	public function testPermalink()
	{
		$this->controller->getInput()->set('paths', array('sakura', 'permalink'));

		$compare = <<<HTML
File: sakura/permalink
uri.base: ../
uri.media: ../media/
config.permalink: foo/bar.html
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());

		$processor = $this->controller->getProcessor();

		$this->assertEquals('foo/bar.html', $processor->getTarget());
	}

	/**
	 * testPermalink
	 *
	 * @return  void
	 */
	public function testPermalinkWithDifferentLevel()
	{
		$this->controller->getInput()->set('paths', array('sakura', 'permalink2'));

		$compare = <<<HTML
File: sakura/permalink2
uri.base: ../../../
uri.media: ../../../media/
config.permalink: foo/bar/baz/yoo.html
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());

		$processor = $this->controller->getProcessor();

		$this->assertEquals('foo/bar/baz/yoo.html', $processor->getTarget());
	}

	/**
	 * testPermalinkIndex
	 *
	 * @return  void
	 */
	public function testPermalinkIndex()
	{
		$this->controller->getInput()->set('paths', array('sakura', 'permalink3'));

		$compare = <<<HTML
File: sakura/permalink3
uri.base: ../../../
uri.media: ../../../media/
config.permalink: foo/bar/baz/
HTML;

		$this->assertStringDataEquals($compare, $this->controller->execute());

		$processor = $this->controller->getProcessor();

		$this->assertEquals('foo/bar/baz/index.html', $processor->getTarget());
	}
}
