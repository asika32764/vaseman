<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman;

use Vaseman\Edge\VasemanEdgeExtension;
use Vaseman\Twig\VasemanTwigExtension;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Event\DispatcherInterface;
use Windwalker\Ioc;
use Windwalker\Renderer\Twig\GlobalContainer;

/**
 * The VasemanPackage class.
 *
 * @since  {DEPLOY_VERSION}
 */
class VasemanPackage extends AbstractPackage
{
    /**
     * Property name.
     *
     * @var  string
     */
    protected $name = 'vaseman';

    /**
     * initialise
     *
     * @return  void
     */
    public function boot()
    {
        // A workaround before Windwalker Loader fix bug
//		class_alias('Windwalker\Loader\Loader\VasemanPsr4Loader', 'Windwalker\Loader\Loader\Psr4Loader');

        parent::boot();

        if (class_exists(\Twig_Extension::class)) {
            GlobalContainer::addExtension('vaseman', new VasemanTwigExtension());
        }

        \Windwalker\Renderer\Edge\GlobalContainer::addExtension(new VasemanEdgeExtension());
    }

    /**
     * registerListeners
     *
     * @param DispatcherInterface $dispatcher
     *
     * @return  void
     */
    public function registerListeners(DispatcherInterface $dispatcher)
    {
        $config = Ioc::getConfig();
    }
}
